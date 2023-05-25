@extends('layouts.default')
@section('title', 'Artist')
@section('content')


<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-sm-12 mt-2">
      <div class="card">
        <div class="card-header">@isset($data) Edit @else Add @endisset Artist</div>
        <div class="card-body">
          <form method="post" action="@isset($data) {{route('artist.edit.post')}} @else {{route('artist.post')}} @endisset">
            @csrf
            <div class="row mb-3"> 
              <div class="col-sm-9">
                @isset($data)
                  <input type="hidden" name="id" value="{{$data->id}}">
                @endisset
                <input type="text" class="form-control" name="artist" value="@isset($data) {{$data->name}} @endisset">
                @foreach($errors->get('artist') as $artist)
                  <div class="alert alert-danger danger-alert" role="alert">
                    {{$artist}}
                  </div>
                @endforeach
              </div>
              <div class="col-sm-3">
                  <button class="btn btn-primary" type="submit">@isset($data) Update @else Add @endisset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-sm-12 mt-2">
      <div class="card">
        <div class="card-header">All Artists</div>
        <div class="card-body">
          <div class="row mb-3"> 
            @if(count($artists)>0)
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($artists as $key => $artist)
                    <tr>
                      <th scope="row">{{++$key}}</th>
                      <td>{{$artist->name}}</td>
                      <td><a class="btn btn-info btn-sm" href="{{route('artist.edit', $artist->id)}}">Edit</a></td>
                      <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"  href="{{route('delete.item',['item' => 'artist','id' => $artist->id])}}">Delete</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <center><h3>No Artist Found!!!</h3></center>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
@stop