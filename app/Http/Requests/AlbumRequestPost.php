<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequestPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    	$rules =  [
				'name' => 'required',
				'description' => 'required|max:50',
        ];
    	
		$photos = count($this->file('photos'));
		
		foreach(range(0, $photos) as $index)
		{
			$rules['photos.' . $index] = 'image|mimes:jpeg,jpg,bmp,png|max:100000000';
		}
	
		return $rules;
    }
}
