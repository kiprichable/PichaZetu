<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $guarded = [];
	
	public function photos()
	{
		return $this->hasMany('App\Models\Photo');
	}
	
	public function photographer($id)
	{
		return User::where('id',Album::find($id)['photographer_id'])->first();
	}
	
	
}
