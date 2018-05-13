<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Requests\AlbumRequestPost;
	use App\Models\Album;
	use App\Models\Photo;
	use App\Models\User;
	use App\Repositories\Image\UploadImagesRepositoryInterface;
	use Carbon\Carbon;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use function in_array;
	use Intervention\Image\Facades\Image;
	use Illuminate\Support\Facades\Session;
	use Illuminate\Support\Facades\Hash;
	use App\Traits\ActivationTrait;
	use jeremykenedy\LaravelRoles\Models\Role;
	
	class albumController extends Controller
	{
		use ActivationTrait;
		protected $images;
		protected $user;
		
		public function __construct(UploadImagesRepositoryInterface $images, User $user)
		{
			$this->images = $images;
			$this->user = $user;
		}
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			if(Auth::user()->level() >= 4)
			{
				$Album = Album::where('user_id',Auth::user()->id)->get();
			}
			else
			{
				$Album = Album::where('customer_id',Auth::user()->id)->get();
			}
			
			return view('albumManagement.index')
				->withAlbums($Album)
				->withUser(User::find($Album[0]['user_id']));
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			return view('albumManagement.create')
				->withPassword($this->user->randomPassword(5));
		}
		
		/**
		 * @param \App\Http\Requests\AlbumRequestPost $request
		 * @return $this|\Illuminate\Database\Eloquent\Model
		 */
		public function store(AlbumRequestPost $request)
		{
			ini_set("memory_limit", "20000M");
			//get all customers
			$users = User::all('name')->toArray();
			//get selected username from form
			$username = $request->input('password');
			//make sure username is not duplicate
			if(in_array($username,$users))
			{
				$username = $username . $this->user->randomPassword(10);
			}
			//compile customer data
			$userData = [
				'name' => $username,
				'first_name' => $request->input('first_name'),
				'last_name' => $request->input('last_name'),
				'email' => $request->input('email'),
				'password' => Hash::make($request->input('password')),
			];
			
			
			//create customer
			$customer = User::create($userData);
			
			$role = Role::where('slug', '=', 'customer')->first();
			
			$customer->attachRole($role);
			
			$this->initiateCustomerActivation($customer);
			$albumData = [
				'user_id' => Auth::user()->id,
				'customer_id' => $customer['id'],
				'name' => $request->input('name'),
				'description' => $request->input('description'),
				
				];
			//create album
			$album = Album::create($albumData);
			
			//check if album exists - user and same photographer
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
			$album = Album::find($id);
			$photo = Photo::where('album_id',$album['id'])->first();
			
			if(empty($album))
			{
				return redirect('albums')->with('error','Album does not exist');
			}
			
			
			return view('albumManagement.show')
				->withAlbum($album)
				->withPhoto($photo)
				->withUser($album->photographer($id));
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
			//dd($request->input());
			Session::flash('success','Album updated successfully');
			//redirect to all albums
			return redirect('albums');
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
			Session::flash('success','Album deleted successfully');
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
		}
	}
