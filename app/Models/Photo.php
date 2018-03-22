<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];
    
    public function albums()
	{
		return $this->belongsTo('App\Models\Album');
	}
}
