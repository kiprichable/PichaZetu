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
		if(!$user)
		{
			return view('errors.no-user')
					   ->withError('The profile page you are trying to access is not registered with picha sell. If you would like to create a profile page do so by registering.');
		}
		return view('profiles.public')
			->withUser($user);
		
	}
}
