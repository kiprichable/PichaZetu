<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUS extends Model
{
	protected $table = 'contact_us';
	use SoftDeletes;
	protected $guarded = ['id'];
}
