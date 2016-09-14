<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function index(Request $request)
    {
    	
        $image = $this->uploadImage($request->file('pic'),'/uploads/users/');
        return response()->json($image);

    }

    public function uploadImage($file, $path, $resize = [400, 200, 100])
    {
        $filename = "photo".date('YmdHis')."".rand().$file->getClientOriginalName();;
        $file_path = public_path().$path;
        $file->move($file_path, $filename);
        $size = getimagesize($file_path.$filename);
        switch(strtolower($size['mime']))
        {
            case 'image/png':
            $source_image = imagecreatefrompng($file_path.$filename);
            break;
            case 'image/jpeg':
            $source_image = imagecreatefromjpeg($file_path.$filename);
            break;
            case 'image/gif':
            $source_image = imagecreatefromgif($file_path.$filename);
            break;
            default: die('image type not supported');
        }
        $resize_url = [];
        foreach ($resize as $key => $value) 
        {
            $width = $value;
            $height = round($width*$size[1]/$size[0]);
            $photoX = ImagesX($source_image);
            $photoY = ImagesY($source_image);
            $images_fin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($images_fin, $source_image, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
            if(!file_exists($file_path.'x'.$value)){
                mkdir($file_path.'x'.$value);
            }
            $resize_url[] = "http://api.528express.com".$path.'x'.$value.'/'.$filename;
            ImageJPEG($images_fin, $file_path.'x'.$value.'/'.$filename, 100);
        }
        ImageDestroy($source_image);
        ImageDestroy($images_fin);
        return ['__type'=>'File', 'name' => $filename, 'url'=>"http://api.528express.com".$path.$filename,'resize_url' => $resize_url];
    }

}
