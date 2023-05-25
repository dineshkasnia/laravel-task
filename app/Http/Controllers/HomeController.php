<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Genre;
use App\Models\Artist;
use App\Models\Venue;
use App\Models\Events;
use DB, Auth, Redirect;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function __construct()  
    {  
        $this->middleware('auth');  
    }   
    public function home()
    {
        $genreCount = Genre::count();
        $artistCount = Artist::count();
        $venueCount = Venue::count();
        $eventCount = Events::count();
        return view('index', compact('genreCount', 'artistCount', 'venueCount', 'eventCount'));
    }

    public function genre()
    {
        $genres = Genre::orderBy('id', 'DESC')->get();
        return view('genre', compact('genres'));
    }
    public function genrePost(Request $request)
    {
        $input = $request->all();
        $rules = [ 'genre' => 'required|min:2|max:50'];
        $names = ['genre' => 'Genre Name'];
        $validation = Validator::make($input, $rules, $names);
        $validation->setAttributeNames($names);
        if($validation->fails())
        {
            return \Redirect::back()->withInput($input)->withErrors($validation);
        }
        else
        {
            $exists = Genre::where('name', $input['genre'])->first();
            if($exists){
                return \Redirect::back()->with('error', 'Genre already exists');
            }
            
            Genre::insert(['name' => $input['genre']]);       
            return \Redirect::route('genre')->with('success', 'Genre is  submitted successfully');
        }
    }

    public function deleteItem($table, $id)
    {
        if(Schema::hasTable($table))
        {
            if($table=='genre' || $table=='artist' || $table=='venue' || $table=='events')
            {
                $item = DB::table($table)->where('id', $id)->first();
                if($item)
                {
                    if($table != 'events')
                    {
                        $field_name = $table."_id";
                        $check = Events::where($field_name, $id)->first();
                        if(!$check)
                        {
                            DB::table($table)->where('id', $item->id)->delete();
                            return \Redirect::back()->with('success', 'Item is  deleted successfully');
                        }
                        else
                        {
                            return \Redirect::back()->with('warning', 'That item is associated with an event');
                        }
                    } 
                    else
                    {
                        DB::table($table)->where('id', $item->id)->delete();
                        return \Redirect::back()->with('success', 'Item is  deleted successfully');
                    }
                }
            } 
        }     
        return \Redirect::back()->with('warning', 'Item not found or invalid request');
    }

    public function genreEdit($id)
    {
        $data = Genre::where('id', $id)->first();
        $genres = Genre::orderBy('id', 'DESC')->get();
        return view('genre', compact('data', 'genres'));
    }

    public function genreEditPost(Request $request)
    {
        $input = $request->all();
        $rules = ['id' => 'required', 'genre' => 'required|min:2|max:50'];
        $names = ['genre' => 'Genre Name'];
        $validation = Validator::make($input, $rules, $names);
        $validation->setAttributeNames($names);
        if($validation->fails())
        {
            return \Redirect::back()->withInput($input)->withErrors($validation);
        }
        else
        {
            $exists = Genre::where('name', $input['genre'])->where('id', '!=', $input['id'])->first();
            if($exists){
                return \Redirect::back()->with('error', 'Genre already exists');
            }
            $check = Genre::where('id', $input['id'])->first();
            if($check){
                Genre::where('id', $check->id)->update(['name' => $input['genre']]);  
                return \Redirect::route('genre')->with('success', 'Genre is  updated successfully');     
            }
            return \Redirect::back()->with('warning', 'Something went wrong');
        }
    }

    public function artist()
    {
        $artists = Artist::orderBy('id', 'DESC')->get();
        return view('artist', compact('artists'));
    }

    public function artistPost(Request $request)
    {
        $input = $request->all();
        $rules = [ 'artist' => 'required|min:2|max:50'];
        $names = ['artist' => 'Artist Name'];
        $validation = Validator::make($input, $rules, $names);
        $validation->setAttributeNames($names);
        if($validation->fails())
        {
            return \Redirect::back()->withInput($input)->withErrors($validation);
        }
        else
        {
            $exists = Artist::where('name', $input['artist'])->first();
            if($exists){
                return \Redirect::back()->with('error', 'Artist already exists');
            }
            
            Artist::insert(['name' => $input['artist']]);       
            return \Redirect::route('artist')->with('success', 'Artist is  submitted successfully');
        }
    }

    public function artistEdit($id)
    {
        $data = Artist::where('id', $id)->first();
        $artists = Artist::orderBy('id', 'DESC')->get();
        return view('artist', compact('data', 'artists'));
    }

    public function artistEditPost(Request $request)
    {
        $input = $request->all();
        $rules = ['id' => 'required', 'artist' => 'required|min:2|max:50'];
        $names = ['artist' => 'Artist Name'];
        $validation = Validator::make($input, $rules, $names);
        $validation->setAttributeNames($names);
        if($validation->fails())
        {
            return \Redirect::back()->withInput($input)->withErrors($validation);
        }
        else
        {
            $exists = Artist::where('name', $input['artist'])->where('id', '!=', $input['id'])->first();
            if($exists){
                return \Redirect::back()->with('error', 'Artist already exists');
            }
            $check = Artist::where('id', $input['id'])->first();
            if($check){
                Artist::where('id', $check->id)->update(['name' => $input['artist']]);  
                return \Redirect::route('artist')->with('success', 'Artist is  updated successfully');     
            }
            return \Redirect::back()->with('warning', 'Something went wrong');
        }
    }

    public function venue()
    {
        $venues = Venue::orderBy('id', 'DESC')->get();
        return view('venue', compact('venues'));
    }

    public function venuePost(Request $request)
    {
        $input = $request->all();
        $rules = [ 
            'venue' => 'required|min:2|max:50',  
            'contact_number' => 'required|numeric|digits_between:10,20', 
            'address' => 'required|min:5|max:150'
        ];
        $names = ['venue' => 'Venue Name', 'contact_number' => 'Contact Number', 'address' => 'Address'];
        $validation = Validator::make($input, $rules, $names);
        $validation->setAttributeNames($names);
        if($validation->fails())
        {
            return \Redirect::back()->withInput($input)->withErrors($validation);
        }
        else
        {
            $exists = Venue::where('name', $input['venue'])->first();
            if($exists){
                return \Redirect::back()->with('error', 'Venue already exists');
            }
            
            Venue::insert([
                'name' => $input['venue'], 
                'contact_number' => $input['contact_number'],
                'address' => $input['address']
            ]);       
            return \Redirect::route('venue')->with('success', 'Venue is  submitted successfully');
        }
    }

    public function venueEdit($id)
    {
        $data = Venue::where('id', $id)->first();
        $venues = Venue::orderBy('id', 'DESC')->get();
        return view('venue', compact('data', 'venues'));
    }

    public function venueEditPost(Request $request)
    {
        $input = $request->all();
        $rules = [
            'id' => 'required|numeric', 
            'venue' => 'required|min:2|max:50',  
            'contact_number' => 'required|numeric|digits_between:10,20',
            'address' => 'required|min:5|max:150'
        ];
        $names = ['venue' => 'Venue Name', 'contact_number' => 'Contact Number', 'address' => 'Address'];
        $validation = Validator::make($input, $rules, $names);
        $validation->setAttributeNames($names);
        if($validation->fails())
        {
            return \Redirect::back()->withInput($input)->withErrors($validation);
        }
        else
        {
            $exists = Venue::where('name', $input['venue'])->where('id', '!=', $input['id'])->first();
            if($exists){
                return \Redirect::back()->with('error', 'Venue already exists');
            }
            $check = Venue::where('id', $input['id'])->first();
            if($check){
                Venue::where('id', $check->id)->update([
                    'name' => $input['venue'],
                    'contact_number' => $input['contact_number'],
                    'address' => $input['address']
                ]);  
                return \Redirect::route('venue')->with('success', 'Venue is  updated successfully');     
            }
            return \Redirect::back()->with('warning', 'Something went wrong');
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('login')->with('success', 'Logged out successfully');
    }

    
}
