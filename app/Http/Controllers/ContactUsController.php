<?php

namespace App\Http\Controllers;

use App\Models\ContactUS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('emails.contact')
			->withTitle('Daniel Cheruiyot')
			->withContent('My email');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Request  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
    	$requestData = $request->input();
    	
    	$requestData += ['user_id' => User::where('name',$id)->first()['id']];
		
		 $request->validate([
			'fname' => 'required',
			'lname' => 'required',
			'email' => 'required',
			'message' => 'required',
		]);
		
		ContactUS::create($requestData);
	
		Mail::send('emails.contact',
			[
				'title' => $request->input('fname') .' ' .$request->input('lname'),
				'content' => $request->get('message')
			],
			function($message,$id)
			{
				$message->from('pichasell@gmail.com');
				$message->to('dcheruiy@d.umn.edu', 'Admin')->subject('Customer Feed Back/ Question');
			});
	
		return back()->with('success', 'Thanks for contacting us!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
