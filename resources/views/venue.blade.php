@extends('layouts.default')
@section('title', 'Venue')
@section('content')


<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-sm-12 mt-2">
      <div class="card">
        <div class="card-header">@isset($data) Edit @else Add @endisset Venue</div>
        <div class="card-body">
          <form method="post" action="@isset($data) {{route('venue.edit.post')}} @else {{route('venue.post')}} @endisset">
            @csrf
            <div class="row mb-1"> 
              <div class="col-sm-6">
                @isset($data)
                  <input type="hidden" name="id" value="{{$data->id}}">
                @endisset
                <input type="text" class="form-control" name="venue" value="@isset($data) {{$data->name}} @endisset" placeholder="Venue Name">
                @foreach($errors->get('venue') as $venue)
                  <div class="alert alert-danger danger-alert" role="alert">
                    {{$venue}}
                  </div>
                @endforeach
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="contact_number" value="@isset($data) {{$data->contact_number}} @endisset" placeholder="Contact Number">
                @foreach($errors->get('contact_number') as $contact_number)
                  <div class="alert alert-danger danger-alert" role="alert">
                    {{$contact_number}}
                  </div>
                @endforeach
              </div>
            </div>
            <div class="row mb-1 mt-3">
              <div class="col-sm-9">
                <textarea class="form-control" name="address" value="@isset($data) {{$data->address}} @endisset" placeholder="Address">@isset($data) {{$data->address}} @endisset</textarea>
                @foreach($errors->get('address') as $address)
                  <div class="alert alert-danger danger-alert" role="alert">
                    {{$address}}
                  </div>
                @endforeach
              </div>
              <div class="col-sm-3">
                  <button class="btn btn-primary" type="submit">@isset($data) Update @else Add @endisset </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-sm-12 mt-2">
      <div class="card">
        <div class="card-header">All Venues</div>
        <div class="card-body">
          <div class="row mb-3"> 
            @if(count($venues)>0)
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Venue</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($venues as $key => $venue)
                    <tr>
                      <th scope="row">{{++$key}}</th>
                      <td>{{$venue->name}}</td>
                      <td>{{$venue->contact_number}}</td>
                      <td>{{$venue->address}}</td>
                      <td><a class="btn btn-info btn-sm" href="{{route('venue.edit', $venue->id)}}">Edit</a></td>
                      <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"  href="{{route('delete.item',['item' => 'venue','id' => $venue->id])}}">Delete</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <center><h3>No Venue Found!!!</h3></center>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
@stop