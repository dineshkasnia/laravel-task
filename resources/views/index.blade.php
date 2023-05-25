@extends('layouts.default')
@section('title', 'Home')
@section('content')
<div class="container mt-4">
<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="card-title">Total Genres</h5>
        <h2 class="card-text">{{ $genreCount > 0 ? $genreCount : 'Add First Genre' }}</h2>
        <a href="{{route('genre')}}" class="btn btn-primary">All Genres</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="card-title">Total Artists</h5>
        <h2 class="card-text">{{ $artistCount > 0 ? $artistCount : 'Add First Artist' }}</h2>
        <a href="{{route('artist')}}" class="btn btn-primary">All Artists</a>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container mt-4">
<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="card-title">Total Venues</h5>
        <h2 class="card-text">{{ $venueCount > 0 ? $venueCount : 'Add First Venue' }}</h2>
        <a href="{{route('venue')}}" class="btn btn-primary">All Venues</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="card-title">Total Events</h5>
        <h2 class="card-text">{{ $eventCount > 0 ? $eventCount : 'Add First Event' }}</h2>
        <a href="{{route('events')}}" class="btn btn-primary">All Events</a>
      </div>
    </div>
  </div>
</div>
</div>
@stop