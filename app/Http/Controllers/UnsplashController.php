<?php
 
namespace App\Http\Controllers;
 
use App\Models\Artists;
use App\Models\Photos;
use App\Models\PhotosPivot;
use Illuminate\Support\Facades\Http;
 
class UnsplashController extends Controller
{
    /**
     * Home photo list
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $getPhotos = Photos::inRandomOrder()
            ->offset(0)
            ->limit(5)
            ->get();

        $totalRecord = $getPhotos->count();

        // OK, we need new records.
        if (! $totalRecord) {

            $unsplashApiKey = env('UNSPLASH_API_KEY');
            $unsplashApiUrl = env('UNSPLASH_API_URL');

            $response = Http::accept('application/json')->get($unsplashApiUrl . 'photos', [
                'client_id' => $unsplashApiKey,
                'per_page' => 100,
            ]);

            // API request is successfully, we can insert data to our database.
            if ($response->successful()) {

                $records = json_decode($response->body());

                $formatData
                Flight::upsert([
                    ['departure' => 'Oakland', 'destination' => 'San Diego', 'price' => 99],
                    ['departure' => 'Chicago', 'destination' => 'New York', 'price' => 150]
                ], ['departure', 'destination'], ['price']);

            }

        }

        echo '<pre>';
        var_dump($records);
        exit;
        return view('unsplash.home');
    }

    /**
     * Artist detail
     * @param artist id <int>
     * @return \Illuminate\View\View
     */
    public function artistDetail($id)
    {
        return view('unsplash.artist', [
            'artistId' => $id
        ]);
    }

    /**
     * Artist detail
     * @param photo id <int>
     * @return \Illuminate\View\View
     */
    public function photoDetail()
    {
        return view('unsplash.photo', [
            'photoId' => $id]
        );
    }
}