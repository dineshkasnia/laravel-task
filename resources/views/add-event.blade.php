@extends('layouts.default')
@section('title', 'Add Event')
@section('content')

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-sm-12">
      <div class="card">
        <div class="card-header">Add  Event</div>
        <div class="card-body">
          <form method="post" action="{{route('event.post')}}" enctype="multipart/form-data">
            @csrf
            <div class="row"> 
              <div class="col-sm-2">
                <label for="inputPassword6" class="col-form-label">Title</label>
              </div>
              <div class="col-sm-9">
                  <input type="text" class="form-control" name="title" value="{{old('title')}}">
                  @foreach($errors->get('title') as $title)
                    <div class="alert alert-danger danger-alert" role="alert">
                      {{$title}}
                    </div>
                  @endforeach
              </div>
            </div>
            <div class="row mt-3"> 
              <div class="col-sm-2">
                <label for="inputPassword6" class="col-form-label">Genre</label>
              </div>
              <div class="col-sm-9">
                  <select name="genre" class="form-control">
                    <option value="">Select Genre</option>
                    @foreach($genres as $genre)
                      <option value="{{$genre->id}}" {{old('genre') == $genre->id ? "selected" : ""}}>{{$genre->name}}</option>
                    @endforeach
                  </select>
                  @foreach($errors->get('genre') as $genrerr)
                    <div class="alert alert-danger danger-alert" role="alert">
                      {{$genrerr}}
                    </div>
                  @endforeach
              </div>
            </div>
            <div class="row mt-3"> 
              <div class="col-sm-2">
                <label class="col-form-label">Artist</label>
              </div>
              <div class="col-sm-9">
                  <select name="artist" class="form-control">
                    <option value="">Select Artist</option>
                    @foreach($artists as $artist)
                      <option value="{{$artist->id}}" {{old('artist') == $artist->id ? "selected" : ""}}>{{$artist->name}}</option>
                    @endforeach
                  </select>
                  @foreach($errors->get('artist') as $artist)
                    <div class="alert alert-danger danger-alert" role="alert">
                      {{$artist}}
                    </div>
                  @endforeach
              </div>
            </div>
            <div class="row mt-3"> 
              <div class="col-sm-2">
                <label for="inputPassword6" class="col-form-label">Description</label>
              </div>
              <div class="col-sm-9">
                  <textarea class="form-control" name="description">{{old('description')}}</textarea>
                  @foreach($errors->get('description') as $description)
                    <div class="alert alert-danger danger-alert" role="alert">
                      {{$description}}
                    </div>
                  @endforeach
              </div>
            </div>
            <div class="row mt-3"> 
              <div class="col-sm-2">
                <label for="inputPassword6" class="col-form-label">Amount</label>
              </div>
              <div class="col-sm-9">
                  <input type="text" class="form-control" name="amount" value="{{old('amount')}}">
                  @foreach($errors->get('amount') as $amount)
                    <div class="alert alert-danger danger-alert" role="alert">
                      {{$amount}}
                    </div>
                  @endforeach
              </div>
            </div>
            <div class="row mt-3"> 
              <div class="col-sm-2">
                <label for="inputPassword6" class="col-form-label">Date</label>
              </div>
              <div class="col-sm-9">
                  <input type="date" class="form-control" name="date" value="{{old('date')}}">
                  @foreach($errors->get('date') as $date)
                    <div class="alert alert-danger danger-alert" role="alert">
                      {{$date}}
                    </div>
                  @endforeach
              </div>
            </div>
            <div class="row mt-3"> 
              <div class="col-sm-2">
                <label for="inputPassword6" class="col-form-label">Venue</label>
              </div>
              <div class="col-sm-9">
                  <select name="venue" class="form-control">
                    <option value="">Select Venue</option>
                    @foreach($venues as $venue)
                      <option value="{{$venue->id}}" {{old('venue') == $venue->id ? "selected" : ""}}>{{$venue->name}}</option>
                    @endforeach
                  </select>
                  @foreach($errors->get('venue') as $venue)
                    <div class="alert alert-danger danger-alert" role="alert">
                      {{$venue}}
                    </div>
                  @endforeach
              </div>
            </div>
            <div class="row mt-3"> 
              <div class="col-sm-2">
                <label for="inputPassword6" class="col-form-label">Image</label>
              </div>
              <div class="col-sm-9">
                  <input type="file" class="form-control" name="image">
                  @foreach($errors->get('image') as $image)
                    <div class="alert alert-danger danger-alert" role="alert">
                      {{$image}}
                    </div>
                  @endforeach
              </div>
            </div>
            <div class="row mt-3"> 
              <div class="col-sm-9">
              </div>
              <div class="col-sm-3">
                  <button class="btn btn-primary" type="submit">Add Event</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@stop