@extends('layouts.default')
@section('title', 'Events')
@section('content')
  <div class="container">
    <div class="row mt-4 mb-4">
      <div class="col-12">
        <div class="card event-card">
          <div class="card-header">
            <div class="row">
              <div class="col-11">All Events</div>
              <div class="col-1">
                <a href="{{route('add.event')}}" class="btn mybtn">+</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row mb-3 table-responsive"> 
              @if(count($events)>0)
                <form method="get" action="{{route('events')}}">
                  <div class="row mb-3">
                    <div class="col-2">
                      <select name="genre" class="form-control">
                        <option value="">Select Genre</option>
                        @foreach($genres as $genre)
                          <option value="{{$genre->id}}" {{\Request::get('genre') == $genre->id ? "selected" : ""}}>{{$genre->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-2">
                      <input type="date" class="form-control" name="date" placeholder="Select date" value="{{\Request::get('date')}}">
                    </div>
                    <div class="col-2">
                      <select name="artist" class="form-control">
                        <option value="">Select Artist</option>
                        @foreach($artists as $artist)
                          <option value="{{$artist->id}}" {{\Request::get('artist') == $artist->id ? "selected" : ""}}>{{$artist->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-2">
                      <select name="venue" class="form-control">
                        <option value="">Select Venue</option>
                        @foreach($venues as $venue)
                          <option value="{{$venue->id}}" {{\Request::get('venue') == $venue->id ? "selected" : ""}}>{{$venue->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-1">
                      <button class="btn btn-primary" type="submit">Filter</button>
                    </div>
                    <div class="col-2">
                      <a class="btn btn-warning" href="{{route('events')}}">Clear Filter</a>
                    </div>
                  </div>
                </form>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Title</th>
                      <th scope="col">Genre</th>
                      <th scope="col">Artist</th>
                      <th scope="col">Image</th>
                      <th scope="col">Description</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Date</th>
                      <th scope="col">Venue</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($events as $key => $event)
                      <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$event->title}}</td>
                        <td>{{$event->genre_name}}</td>
                        <td>{{$event->artist_name}}</td>
                        <td><a href="{{ asset('image/'.$event->image) }}" target="_blank" data-toggle="tooltip" title="Click me to open in new tab"><img src="image/{{$event->image}}" width="50" height="50" /></a></td>
                        <td>{{$event->description}}</td>
                        <td>{{$event->amount}}</td>
                        <td>{{$event->date}}</td>
                        <td>{{$event->venue_name}}</td>
                        <td><a class="btn btn-info btn-sm" href="{{route('event.edit', $event->id)}}">Edit</a></td>
                        <td><a class="btn btn-danger btn-sm" href="{{route('delete.item',['item' => 'events','id' => $event->id])}}">Delete</a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @else
                <center><h3>No Event Found!!!</h3></center>
                @if(\Request::get('genre') || \Request::get('artist') || \Request::get('date') || \Request::get('venue'))
                  <div class="col">
                    <center><a class="btn btn-warning" href="{{route('events')}}">Clear Filter</a></center>
                  </div>
                @endif
              @endif
            </div>
            {!! $events->links() !!}
          </div>
        </div>
      </div>
    </div>
  </div>


<div class="modal fade" id="search-action-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Event Detail</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    
                <div class="row" id="modl-content">
                    
                </div>

                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button> 
            </div>
        </div>
    </div>
</div>



@stop