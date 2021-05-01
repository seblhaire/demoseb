<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seblhaire\Uploader\UploaderHelper;

class UploaderController extends Controller
{
  public function index()
  {
    /*first uoloader with default params*/
    $uploader = UploaderHelper::init(
      'uploaderdiv',
      'Simple uploader',
      route('fileupload')
    );
    /* uploader with drag zone disabled*/
    $uploader2 = UploaderHelper::init(
      'uploaderdiv2',
      'Uploader 2',
      route('fileupload'),
      ['draggable' => false]
    );
    /* complete example with result list*/
    $uploader3 = UploaderHelper::init(
      'uploaderdiv3',
      'Uploader',
      route('fileupload'),
      [
        'resultclass' => 'UploaderResult'
      ], [ // additional parameters transmitted to second script
        'article_title' => "l'ami",
        'article_id' => 40
    ]);
    /*uploader that will be hidden in the beginning*/
    $uploader4 = UploaderHelper::init(
      'uploaderdiv4',
      'Uploader 4',
      route('fileupload'),
      [
        'hidden' => true,
        'resultclass' => 'UploaderResult2'
    ]);
    return view('uploader', [
        'title' => 'Uploader',
        'menu' => 'uploader',
        'extensions' => config('uploader.acceptable_mimes'),
        'maxsize' => '1MB',
        'filelife' => 10,
        'uploader' => $uploader,
        'uploader2' => $uploader2,
        'uploader3' => $uploader3,
        'uploader4' => $uploader4,
      ]);
  }

  public function processFile(Request $request)
  {
    /*
    here you could / should register your file into database or whatever you need
    instead of this dummy function
    */
    $res = array_merge(['pseudo_file_id' => random_int(1, PHP_INT_MAX)], $request->toArray());
    return response()->json($res);
  }

  public function deleteFiles(){
    collect(Storage::disk('public')->listContents('/uploads'))
  	->each(function($file) {
  		if ($file['type'] == 'file' && $file['timestamp'] < \Carbon\Carbon::now('Europe/Zurich')->subMinutes(15)->getTimestamp()) {
  			Storage::disk('public')->delete($file['path']);
  		}
  	});
  }
}
