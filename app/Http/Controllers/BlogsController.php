<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPost;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
	 * @param \App\Http\Requests\StoreBlogPost $request
	 * @return \Illuminate\Http\RedirectResponse
	 *
	 */
    public function store(StoreBlogPost $request)
    {
    	$requestData = $request->input();
    	$requestData += ['user_id' => Auth::user()->id];
    	$requestData += ['created_by' => Auth::user()->name];
    	
    	Blog::create($requestData);
		
		return redirect('profile/'.Auth::user()->name)->with('success', trans('profile.blogCreatedSuccess'));
		
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
