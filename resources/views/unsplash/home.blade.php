@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="row">
        @foreach ($photos as $photo)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm">
                    <img class="card-img-top" width="100%" height="225" src="{{ $photo->pivot->small_url }}" alt="{{ $photo->description }}" />
                    <div class="card-body">
                        <p class="card-text">{{ $photo->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ url('/photo/' . $photo->photo_id ) }}" class="btn btn-sm btn-outline-secondary">View</a>
                            </div>
                            <small class="text-muted">by {{ '@'.$photo->artist->username }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection