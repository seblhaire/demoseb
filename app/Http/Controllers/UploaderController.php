<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seblhaire\Uploader\UploaderHelper;
use Illuminate\Support\Facades\Storage;
use Seblhaire\MenuAndTabUtils\MenuUtils;

class UploaderController extends Controller
{
  public function index($type = 'simple')
  {
    $acceptable ='png,jpg,jpeg,gif,txt';
    /*first uoloader with default params*/
    switch($type){
      case 'basic' :// simple uploader
        /* uploader with drag zone disabled*/
        $uploader = UploaderHelper::init(
          'uploaderdiv2', //uploader id
          'Uploader', //label
          route('fileupload'), // route for file prodessing
          [
            'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
            'draggable' => false, // drag and drop disabled
            'acceptable_mimes' => $acceptable, // comma-separated list of valid extensions
            'maxfilesizek' => 1024, // max file size
            'path' => '/uploads', // folder in storage where files must be uploaded
            'storagename' => 'public', // file storage
          ]
        );
        break;
      case 'complete':
        /* complete example with result list*/
        $uploader = UploaderHelper::init(
          'uploaderdiv3', //uploader id
          'Uploader',//label
          route('fileupload2'), // route for file prodessing
          [
            'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
            'resultclass' => 'UploaderResult', // class of object containing files list
            'multiple' => true, // multiple files can be uploaded
            'acceptable_mimes' => $acceptable,  // comma-separated list of valid extensions
          ], [ // additional parameters transmitted to upload script
            'article_title' => "l'ami",
            'article_id' => 40
        ]);
        break;
      case 'hidden':
        /*uploader that will be hidden in the beginning*/
        $uploader = UploaderHelper::init(
          'uploaderdiv4', //uploader id
          'Uploader',//label
          route('fileupload'), // route for file prodessing
          [
            'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
            'hidden' => true, // uploader is invisible when inited
            'resultclass' => 'UploaderResult',
            'acceptable_mimes' => $acceptable,  // comma-separated list of valid extensions
            'maxfilesizek' => 1024, // max file size
            'multiple' => true, // multiple files can be uploaded
            'path' => '/uploads', // folder in storage where files must be uploaded
            'storagename' => 'public', // file storage
        ]);
        break;
      case 'simple' :// simple uploader
        $uploader = UploaderHelper::init(
          'uploaderdiv', //label
          'Uploader', //label
          route('fileupload'), // route for file prodessing
          [
            'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
            'acceptable_mimes' => $acceptable,  // comma-separated list of valid extensions
            'maxfilesizek' => 1024, // max file size
            'path' => '/uploads', // folder in storage where files must be uploaded
            'storagename' => 'public', // file storage
            'overwrite' => true, // files can be overwritten, if false, new name is generated
            'multiple' => true // multiple files can be uploaded
          ]
        );
        break;
        default:
          $uploader = null;
    }
    $sidemenu = MenuUtils::init('uploader-menu', [
      'ulclass' => 'nav flex-column sidemenu',
      'menu' => [
        'simpleupl-menu' => [
          'title' => 'Simple uploader',
          'target' => route('uploader', ['type' => 'simple'])
        ],
        'basicupl-menu' => [
          'title' => 'Simple uploader w/o drag-and-drop',
          'target' => route('uploader', ['type' => 'basic'])
        ],
        'completeupl-menu' => [
          'title' => 'Complete uploader',
          'target' => route('uploader', ['type' => 'complete'])
        ],
        'hiddenupl-menu' => [
          'title' => 'Hidden uploader',
          'target' => route('uploader', ['type' => 'hidden'])
        ],
        'functionsupl-menu' => [
          'title' => 'Upload functions',
          'target' => route('uploader', ['type' => 'functions'])
        ],
      ]
    ]);
    return view('uploader', [
        'title' => 'Uploader',
        'type' => $type,
        'mainmenu' => $this->mainmenu->setCurrent('packages-topmenu'),
        'rightmenu' => $this->rightmenu,
        'sidemenu' => $sidemenu->setCurrent($type . 'upl-menu'),
        'extensions' => $acceptable,
        'maxsize' => '1MB',
        'filelife' => 10,
        'uploader' => $uploader,
      ]);
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
