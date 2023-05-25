<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Events;
use App\Models\Genre;
use App\Models\Artist;
use App\Models\Venue;
use DB, Auth, Redirect, Response, DateTime;
use Illuminate\Support\Facades\Schema;

class EventController extends Controller
{
    public function __construct()  
    {  
        $this->middleware('auth');  
    }

    public function events(Request $request)
    {
        $genres = Genre::orderBy('name', 'ASC')->get();
        $artists = Artist::orderBy('name', 'ASC')->get();
        $venues = Venue::orderBy('name', 'ASC')->get();
        $events = Events::leftJoin('genre', 'events.genre_id', '=', 'genre.id')
                        ->leftJoin('venue', 'events.venue_id', '=', 'venue.id')
                        ->leftJoin('artist', 'events.artist_id', '=', 'artist.id');

                    
        if($request->genre)
        {
            $complaints = $events->where('events.genre_id', $request->genre);
        }

        if($request->artist)
        {
            $complaints = $events->where('events.artist_id', $request->artist);
        }

        if($request->venue)
        {
            $complaints = $events->where('events.venue_id', $request->venue);
        }

        if($request->date)
        {
            $complaints = $events->where('events.date', $request->date);
        }

        $events = $events->select(
                            'events.*', 
                            'genre.name as genre_name', 
                            'artist.name as artist_name', 
                            'venue.name as venue_name'
                        )
                        ->orderBy('id', 'DESC')
                        ->paginate(10);

        return view('events', compact('events', 'genres', 'artists', 'venues'));
    }

    public function addEvent()
    {
        $genres = Genre::orderBy('name', 'ASC')->get();
        $artists = Artist::orderBy('name', 'ASC')->get();
        $venues = Venue::orderBy('name', 'ASC')->get();
        return view('add-event', compact('genres', 'artists', 'venues'));
    }

    public function eventPost(Request $request)
    {
        $input = $request->all();
        $rules = [ 
            'title' => 'required|min:3|max:50', 
            'genre' => 'required|numeric',
            'image' => 'image|max:2048',
            'description' => 'required|min:5|max:500',
            'amount' => 'required|numeric|min:10|max:100000000',
            'date' => 'required|date_format:Y-m-d',
            'venue' => 'required|numeric',
            'artist' => 'required|numeric'
        ];
        $names = [
            'title' => 'Title', 
            'genre' => 'Genre',
            'image' => 'Image',
            'description' => 'Description',
            'amount' => 'Amount',
            'date' => 'Date',
            'venue' => 'Venue',
            'artist' => 'Artist'
        ];
        $validation = Validator::make($input, $rules, $names);
        $validation->setAttributeNames($names);
        if($validation->fails())
        {
            return \Redirect::back()->withInput($input)->withErrors($validation);
        }
        else
        {
            $now = new \DateTime();
            $ymdNow = $now->format('Y-m-d');
            if($ymdNow>$input['date'])
                return \Redirect::back()->with('error', "You can't book an event on back date");

            $exists = Events::where('artist_id', $input['artist'])->where('date', $input['date'])->first();
            if($exists){
                return \Redirect::back()->with('error', 'Event already exists')->withInput($input);
            }
            $image_name = NULL;

            if (!empty($request->hasFile('image'))) {
                $image = $request->file('image');
                $destinationPath = 'image/'; // upload path
                $file_ext = $image->getClientOriginalExtension();
                $image_name = time() ."." .$file_ext;
                $image->move($destinationPath, $image_name);
            }
            
            Events::insert([
                'title' => $input['title'],
                'genre_id' => $input['genre'],
                'image' => $image_name,
                'description' => $input['description'],
                'amount' => $input['amount'],
                'date' => $input['date'],
                'venue_id' => $input['venue'],
                'artist_id' => $input['artist']
            ]);       
            return \Redirect::route('events')->with('success', 'Event is  submitted successfully');
        }
    }

    public function editEvent($id)
    {
        $genres = Genre::orderBy('name', 'ASC')->get();
        $artists = Artist::orderBy('name', 'ASC')->get();
        $venues = Venue::orderBy('name', 'ASC')->get();
        $event = Events::find($id);
        if(!$event){
            return \Redirect::route('events')->with('warning', 'Something went wrong');
        }
        return view('edit-event', compact('genres', 'event', 'artists', 'venues'));
    }

    public function eventEditPost(Request $request)
    {
        $input = $request->all();
        $rules = [ 
            'id' => 'required|numeric',
            'title' => 'required|min:3|max:50', 
            'genre' => 'required|numeric',
            'image' => 'image|max:2048',
            'description' => 'required|min:5|max:500',
            'amount' => 'required|numeric|min:10|max:100000000',
            'date' => 'required|date_format:Y-m-d',
            'venue' => 'required|numeric',
            'artist' => 'required|numeric'
        ];
        $names = [
            'title' => 'Title', 
            'genre' => 'Genre',
            'image' => 'Image',
            'description' => 'Description',
            'amount' => 'Amount',
            'date' => 'Date',
            'venue' => 'Venue',
            'artist' => 'Artist'
        ];
        $validation = Validator::make($input, $rules, $names);
        $validation->setAttributeNames($names);
        if($validation->fails())
        {
            return \Redirect::back()->withInput($input)->withErrors($validation);
        }
        else
        {
            $exists = Events::where('artist_id', $input['artist'])->where('date', $input['date'])->where('id', '!=', $input['id'])->first();
            if($exists){
                return \Redirect::back()->with('error', 'Event already exists');
            }

            $event = Events::where('id', $input['id'])->first();
            if(!$event){
                return \Redirect::back()->with('warning', 'Something went wrong');
            }


            $now = new \DateTime();
            $ymdNow = $now->format($event->date);
            if($ymdNow>$input['date'])
                return \Redirect::back()->with('error', "You can't change event date to calendar back date");
            

            
            
            $image_name = $event->image;

            if (!empty($request->hasFile('image'))) {
                $image = $request->file('image');
                $destinationPath = 'image/'; // upload path
                $file_ext = $image->getClientOriginalExtension();
                $image_name = time() ."." .$file_ext;
                $image->move($destinationPath, $image_name);
            }
            
            Events::where('id', $input['id'])->update([
                'title' => $input['title'],
                'genre_id' => $input['genre'],
                'image' => $image_name,
                'description' => $input['description'],
                'amount' => $input['amount'],
                'date' => $input['date'],
                'venue_id' => $input['venue'],
                'artist_id' => $input['artist']
            ]);       
            return \Redirect::route('events')->with('success', 'Event is  updated successfully');
        }
    }


    public function searchPost(Request $request){
        $search = $request->search;
        $output = "";
        if(strlen($search)>49){
            $output.="<center><h3>String length is too long.</h3></center>";

            return Response::json(['data' => $output]);
        }
        $data = Events::where('title', 'LIKE', '%'.$search.'%')
                        ->leftJoin('genre', 'events.genre_id', '=', 'genre.id')
                        ->leftJoin('venue', 'events.venue_id', '=', 'venue.id')
                        ->leftJoin('artist', 'events.artist_id', '=', 'artist.id')
                        ->select(
                            'events.*', 
                            'genre.name as genre_name', 
                            'artist.name as artist_name', 
                            'venue.name as venue_name'
                        )->orderBy('id', 'DESC')
                        ->get();
        if(count($data)>0){
            $output="<table class='table table-bordered'>";
            foreach ($data as $key => $row) {
                $output.="<tr>".
                "<td>".
                "<a href='#' data-bs-target='#search-action-modal' data-bs-toggle='modal' data-id='".$row->id."' data-array='".$row."'>".$row->title."</a>".
                "</td>".
                "<td>".$row->date."</td>".
                "</tr>";
            }
            $output.="</table>";
        }
        else{
            $output = 0;
        }
        return Response::json(['data' => $output]);
    }
}
