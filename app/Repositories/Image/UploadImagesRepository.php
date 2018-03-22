<?php
	
	namespace App\Repositories\Image;
	
	use App\Models\Album;
	use App\Models\Photo;
	use Illuminate\Support\Facades\Session;
	use Illuminate\Support\Facades\Auth;
	use Intervention\Image\Facades\Image;
	
	class UploadImagesRepository implements UploadImagesRepositoryInterface
	{
		public function find($id)
		{
			return Album::find($id);
		}
		public function uploadWaterMarkedImage($image, $path)
		{
		
			$img = Image::make($image);
			
			// use callback to define details
			$start = 0;
			//loop through image size width
			for($x = 0; $x <= $img->width () / 100; $x++) {
				$start += 100;
				$img->text (Auth::user ()->name . ' Photography' . ' ' . Auth::user ()->name . ' Photography' . Auth::user ()->name . ' Photography' . ' ' . Auth::user ()->name . ' Photography' . ' ' . Auth::user ()->name . ' Photography' . ' ' . Auth::user ()->name . ' Photography' . ' ' . Auth::user ()->name . ' Photography' . ' ' . Auth::user ()->name . ' Photography' . ' ' . Auth::user ()->name . ' Photography' . ' ' . Auth::user ()->name . ' Photography' . ' ', $start, $start, function($font) {
					$font->file ('century-gothic/GOTHIC.TTF');
					$font->size (24);
					$font->color (array(255, 255, 255, 0.5));
					$font->align ('center');
					$font->valign ('top');
					$font->angle (45);
				});
			}
			
			$img->save ('WatermarkedImages/'.$path);
			
			Session::flash ('Success', 'Watermarked images saved.');
		}
		public function uploadOriginalImage ($id, $img, $path)
		{
			$img = Image::make($img);
			$img->save ('OriginalImages/'.$path);
			
			Session::flash ('Success', 'Original images saved.');
		}
		public function uploadImage ($requestData)
		{
			Photo::create ($requestData);
			Session::flash ('Success', 'Image saved.');
		}
		
	}