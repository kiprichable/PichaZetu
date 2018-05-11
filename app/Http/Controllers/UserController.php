<?php

namespace App\Http\Controllers;

use Auth;
use function redirect;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(Auth::user()->level() <= 4)
		{
		 return  redirect('albums');
		}
		else {
			$user = Auth::user ();
			
			return view ('profiles.public')->withUser ($user);
		}
		
    }
}
