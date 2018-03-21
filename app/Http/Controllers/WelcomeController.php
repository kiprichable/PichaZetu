<?php

namespace App\Http\Controllers;

use App\Models\User;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
		return view('landing.home');
    }
	
	public function show($username)
	{
		$user = User::where('name',$username)->first();
		return view('profiles.public')
			->withUser($user);
		
	}
}
