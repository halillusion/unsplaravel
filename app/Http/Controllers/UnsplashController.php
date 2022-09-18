<?php
 
namespace App\Http\Controllers;
 
use App\Models\Artists;
use App\Models\Photos;
use App\Models\PhotosPivot;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Http\Request;
 
class UnsplashController extends Controller
{
    /**
     * Home photo list
     *
     * @return \Illuminate\View\View
     */
    public function home(Request $request)
    {
        $this->fetchPhotos();

        $perPage = 16;
        $totalRecord = Artists::count();
        $lastPage = !$totalRecord ? 1 : ceil($totalRecord / $perPage);
        $page = is_numeric($request->page) ? ($totalRecord ? $request->page : 1) : 1;
        if ($page > $lastPage)
            $page = $lastPage;

        $offset = ($page - 1) * $perPage;

        $getArtists = Artists::latest()
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return Inertia::render(
            'Home',
            [
                'title' => 'Discover Unsplash Artists!' . ($page > 1 ? ' - Page ' . $page : ''),
                'sub_title' => 'A sample Unsplash API Client',
                'description' => 'It is a sample project that presents the content provided by the Unsplash API. It adds 30 random photos to its database by querying once a day.',
                'artists' => $getArtists,
                'totalRecord' => $totalRecord,
                'currentPageNum' => (int) $page,
                'lastPage' => $lastPage
            ]
        );
    }

    /**
     * Artist detail
     * @param artist id <string>
     * @return \Illuminate\View\View
     */
    public function artistDetail($id, Request $request)
    {
        $getArtist = Artists::where('artist_id', $id)->first();
        if ($getArtist)
            $this->fetchPhotos($getArtist->username);
        
        $getPhotos = Photos::where('artist_id', $id)->get();

        $perPage = 16;
        $totalRecord = Photos::where('artist_id', $id)->count();
        $lastPage = !$totalRecord ? 1 : ceil($totalRecord / $perPage);
        $page = is_numeric($request->page) ? ($totalRecord ? $request->page : 1) : 1;
        if ($page > $lastPage)
            $page = $lastPage;

        $offset = ($page - 1) * $perPage;

        $getPhotos = Photos::latest()
            ->where('artist_id', $id)
            ->offset($offset)
            ->limit($perPage)
            ->get();

        $_getPhotos = [];
        foreach ($getPhotos as $photo) {
            $photo  = (object) [
                'photo_id' => $photo->photo_id,
                'artist_id' => $photo->artist_id,
                'color' => $photo->color,
                'description' => $photo->description,
                'likes' => $photo->likes,
                'pivot' => $photo->pivot
            ];
            $_getPhotos[] = $photo;
        }
        $getPhotos = $_getPhotos;

        return Inertia::render(
            'Artist',
            [
                'title' => 'Artist' . ($getArtist ? ' - ' . $getArtist->name : ''),
                'id' => $id,
                'artist' => $getArtist,
                'photos' => $getPhotos,
                'totalRecord' => $totalRecord,
                'currentPageNum' => (int) $page,
                'lastPage' => $lastPage
            ]
        );
    }

    /**
     * Artist detail
     * @param photo id <string>
     * @return \Illuminate\View\View
     */
    public function photoDetail($id)
    {
        $getArtist = null;

        $getPhoto = Photos::where('photo_id', $id)->first();
        
        if ($getPhoto) {
            $getArtist = Artists::where('artist_id', $getPhoto->artist_id)->first();
            $getPhoto->pivot = $getPhoto->pivot;
        }


        return Inertia::render(
            'Photo',
            [
                'title' => 'Photo' . ($getArtist ? ' - ' . $getArtist->name : ''),
                'id' => $id,
                'artist' => $getArtist,
                'photo' => $getPhoto,
            ]
        );
    }

    public function fetchPhotos($username = null) {

        $totalRecord = ! is_null($username) ? 
            Photos::where('artist_id', $username)->count() : 
            Photos::count();

        $lastRecord = !is_null($username) ? 
            Photos::where('artist_id', $username)->latest('updated_at')->first(['updated_at']) : 
            Photos::latest('updated_at')->first(['updated_at']);


        // OK, we need new records.
        if (
            ! $totalRecord OR 
            strtotime(
                !is_null($username) ? '-2 hours' : '-1 days'
            ) > strtotime((string)$lastRecord->updated_at)
        ) {

            $unsplashApiKey = env('UNSPLASH_API_KEY');
            $unsplashApiUrl = env('UNSPLASH_API_URL');

            $response = Http::accept('application/json')->get($unsplashApiUrl . (!is_null($username) ? 'users/'. $username.'/photos' : 'photos/random'), [
                'client_id' => $unsplashApiKey,
                'count' => 30,
            ]);

            // API request is successfully, we can insert data to our database.
            if ($response->successful()) {

                $records = json_decode($response->body());

                $formatData = [
                    'artists'       => [],
                    'photos'        => [],
                    'photos_pivot'  => [],
                ];

                // Format the data for our table layout.
                foreach ($records as $record) {

                    $formatData['artists'][] = [
                        'artist_id' => $record->user->id,
                        'username' => $record->user->username,
                        'name' => $record->user->name,
                        'avatar' => $record->user->profile_image->large,
                        'bio' => $record->user->bio,
                        'location' => $record->user->location,
                        'link' => $record->user->links->html
                    ];

                    $formatData['photos'][] = [
                        'photo_id' => $record->id,
                        'artist_id' => $record->user->id,
                        'color' => $record->color,
                        'description' => $record->description,
                        'likes' => $record->likes
                    ];

                    $formatData['photos_pivot'][] = [
                        'photo_id' => $record->id,
                        'raw_url' => $record->urls->raw,
                        'full_url' => $record->urls->full,
                        'regular_url' => $record->urls->regular,
                        'small_url' => $record->urls->small,
                        'thumb_url' => $record->urls->thumb
                    ];
                }

                // Insert or Update Artists
                Artists::upsert(
                    $formatData['artists'], 
                    ['artist_id'], 
                    ['username', 'name', 'avatar', 'bio', 'location', 'link']
                );

                // Insert or Update Photos
                Photos::upsert(
                    $formatData['photos'], 
                    ['artist_id', 'photo_id'], 
                    ['color', 'description', 'likes']
                );

                // Insert or Update Photos Pivot
                PhotosPivot::upsert(
                    $formatData['photos_pivot'], 
                    ['photo_id'], 
                    ['raw_url', 'full_url', 'regular_url', 'small_url', 'thumb_url']
                );

            }

        }
    }
}