<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Requests\AlbumRequestPost;
	use App\Models\Album;
	use App\Models\Photo;
	use App\Repositories\Image\UploadImagesRepositoryInterface;
	use Carbon\Carbon;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Intervention\Image\Facades\Image;
	use Illuminate\Support\Facades\Session;
	
	class albumController extends Controller
	{
		protected $images;
		
		public function __construct(UploadImagesRepositoryInterface $images)
		{
			$this->images = $images;
		}
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			return view('albumManagement.index')->withAlbums(Album::all());
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			return view('albumManagement.create');
		}
		
		/**
		 * @param \App\Http\Requests\AlbumRequestPost $request
		 * @return $this|\Illuminate\Database\Eloquent\Model
		 */
		public function store(AlbumRequestPost $request)
		{
			ini_set("memory_limit", "20000M");
			$results = $request->input();
			$results += ['user_id' => 1];//get user id
			$results += ['photographer_id' => Auth::user()->id]; //get logged in user;
			//check if album exists - user and same photographer
			$album = Album::create($results);
			
			if($request->file('photos'))
			{
				foreach($request->file('photos') as $img)
				{
					$path = $album['id'].uniqid().'.jpg';
					$requestData = [
						'album_id' => $album['id'],
						'name' => $path,
						'watermarked' => 'WatermarkedImages',
						'original' => 'OriginalImages',
						'created_by' =>Auth::user()->id,
						'created_at' => Carbon::now(),
					];
					
					$this->images->uploadImage($requestData);
					$this->uploadOriginalImage($img,$path);
					$this->uploadWaterMarkedImage($img,$path);
				}
			}
			return redirect('albums/'.$album['id'])
				->withAlbum($album)
				->withSuccess('Album created successfully.');
			
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
			return view('albumManagement.show')
				->withAlbum(Album::find($id));
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function edit($id)
		{
			return view('albumManagement.edit')->withAlbum(Album::find($id));
			
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
			//get photos
			$photos = Photo::where('album_id',$id)->get();
			
			//foreach photos delete from storage
			foreach($photos as $photo)
			{
				//delete original image
				unlink($photo->original.'/'.$photo->name);
				//delete watermarked image
				unlink($photo->watermarked.'/'.$photo->name);
				//delete photo
				$photo->delete();
			}
			//delete the album
			Album::find($id)->delete();
			//flash message
			Session::flash('Success','Album deleted successfully');
			//redirect to all albums
			return redirect('albums');
		}
		
		/**
		 * @param $img
		 * @param $path
		 */
		public function uploadOriginalImage($img,$path)
		{
			$img = Image::make ($img);
			$img->save ('OriginalImages/' . $path);
			Session::flash ('Success', 'Original images saved.');
			
		}
		
		/**
		 * @param $image
		 * @param $path
		 */
		public function uploadWaterMarkedImage($image,$path)
		{
			
			$img = Image::make ($image);
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
			
			$img->save ('WatermarkedImages/' . $path);
			
			
			Session::flash ('Success', 'Watermarked images saved.');
		}
	}
