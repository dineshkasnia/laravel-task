@extends('layouts.default')
@section('title', 'Genre')
@section('content')


<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-sm-12 mt-2">
      <div class="card">
        <div class="card-header">@isset($data) Edit @else Add @endisset Genre</div>
        <div class="card-body">
          <form method="post" action="@isset($data) {{route('genre.edit.post')}} @else {{route('genre.post')}} @endisset">
            @csrf
            <div class="row mb-3"> 
              <div class="col-sm-9">
                @isset($data)
                  <input type="hidden" name="id" value="{{$data->id}}">
                @endisset
                <input type="text" class="form-control" name="genre" value="@isset($data) {{$data->name}} @endisset">
                @foreach($errors->get('genre') as $genre)
                  <div class="alert alert-danger danger-alert" role="alert">
                    {{$genre}}
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
        <div class="card-header">All Genres</div>
        <div class="card-body">
          <div class="row mb-3"> 
            @if(count($genres)>0)
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
                  @foreach($genres as $key => $genre)
                    <tr>
                      <th scope="row">{{++$key}}</th>
                      <td>{{$genre->name}}</td>
                      <td><a class="btn btn-info btn-sm" href="{{route('genre.edit', $genre->id)}}">Edit</a></td>
                      <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" href="{{route('delete.item',['item' => 'genre','id' => $genre->id])}}">Delete</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <center><h3>No Genre Found!!!</h3></center>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
@stop