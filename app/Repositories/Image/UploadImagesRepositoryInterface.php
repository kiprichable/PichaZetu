<?php
	namespace App\Repositories\Image;
	
	interface UploadImagesRepositoryInterface
	{
		public function find($id);
		public function uploadWaterMarkedImage($files,$path);
		public function uploadOriginalImage($id,$files,$path);
		public function uploadImage($requestData);
		
	}