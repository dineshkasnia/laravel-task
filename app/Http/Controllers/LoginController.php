<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use DB, Hash, Auth, Redirect;

class LoginController extends Controller
{
    public function login()
    {
        if(Auth::check()){
            return \Redirect::route('home');
        }
        else{
            return view('login');
        }
    }

    public function loginPost(Request $request)
    {
        $input = $request->all();
        $rules = [ 'email' => 'required', 'password' => 'required'];
        $names = ['email' => 'Email', 'password' => 'Password'];
        $validation = Validator::make($input, $rules, $names);
        $validation->setAttributeNames($names);
        if($validation->fails())
        {
            return \Redirect::back()->withInput($input)->withErrors($validation);
        }
        else
        {
            if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) 
            {
                return \Redirect::route('home')->with('success', 'Admin successfully logged in');
            }
            else
            {
                return \Redirect::back()->with('error', 'Error in login');
            }
        }
    }
}
