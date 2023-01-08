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
    $acceptable = config('uploader.acceptable_mimes');
    /*first uoloader with default params*/
    $uploader2 = null;
    switch($type){
      case 'basic' :// simple uploader
        /* uploader with drag zone disabled*/
        $acceptable = 'png,jpg,jpeg,gif,txt';
        $uploader = UploaderHelper::init(
          'uploaderdiv2', //uploader id
          'Uploader', //label
          route('fileupload'), // route for file prodessing
          [
            'draggable' => false, // drag and drop disabled
            'acceptable_mimes' => $acceptable, // comma-separated list of valid extensions
            'maxfilesizek' => 1024, // max file size
            'path' => '/uploads', // folder in storage where files must be uploaded
            'storagename' => 'public', // file storage
            'afteruploadfn' => 'writeinupres',  //callback after file upload success (here it puts results in above text area)
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
            'filecontainer' => 'UploadedFileContainerExt', // class of object containing files replaces default class
            'multiple' => true, // multiple files can be uploaded,
            'maxfilesizek' => 1024, // max file size
            'path' => '/uploads', // folder in storage where files must be uploaded
            'storagename' => 'public', // file storage
            'delurl' => route('filedelete'), // route to file delete method that will be sent to result processor
            'additionalparamsfn' => 'getparams', //function to dynamically set additional parameters sent to file upload method
            'afteruploadfn' => 'writeinupres',  //callback after file upload success (here it puts results in above text area)
          ], [ // additional parameters transmitted to upload script
            'type' => "cover",
        ]);
        break;
      case 'displayinit':
        $uploader = UploaderHelper::init(
          'uploaderdiv4', //uploader id
          'Uploader',//label
          route('fileupload'), // route for file prodessing
          [
            'filecontainer' => 'UploadedFileContainerExt',
            'maxfilesizek' => 1024, // max file size
            'multiple' => true, // multiple files can be uploaded
            'path' => '/uploads', // folder in storage where files must be uploaded
            'storagename' => 'public', // file storage
            'delurl' => route('filedelete'), // route to file delete method that will be sent to result processor
            'afteruploadfn' => 'writeinupres',  //callback after file upload success (here it puts results in above text area)
        ]);
        $uploader2 = UploaderHelper::init(
          'uploaderdiv5', //uploader id
          'Uploader 2',//label
          route('fileupload'), // route for file prodessing
          [
            'filecontainer' => 'UploadedFileContainerExt',
            'maxfilesizek' => 1024, // max file size
            'path' => '/uploads', // folder in storage where files must be uploaded
            'storagename' => 'public', // file storage
            'delurl' => route('filedelete'), // route to file delete method that will be sent to result processor
            'afteruploadfn' => 'writeinupres',  //callback after file upload success (here it puts results in above text area)
        ]);
        break;
      case 'hidden':
        /*uploader that will be hidden in the beginning*/
        $uploader = UploaderHelper::init(
          'uploaderdiv4', //uploader id
          'Uploader',//label
          route('fileupload'), // route for file prodessing
          [
            'hidden' => true, // uploader is invisible when inited
            'filecontainer' => 'UploadedFileContainerExt',
            'maxfilesizek' => 1024, // max file size
            'path' => '/uploads', // folder in storage where files must be uploaded
            'storagename' => 'public', // file storage
            'delurl' => route('filedelete'), // route to file delete method that will be sent to result processor
            'afteruploadfn' => 'writeinupres',  //callback after file upload success (here it puts results in above text area)
        ]);
        $uploader2 = UploaderHelper::init(
          'uploaderdiv5', //uploader id
          'Uploader 2',//label
          route('fileupload'), // route for file prodessing
          [
            'hiddenuploader' => true, // uploader is invisible when inited
            'filecontainer' => 'UploadedFileContainerExt',
            'maxfilesizek' => 1024, // max file size
            'path' => '/uploads', // folder in storage where files must be uploaded
            'storagename' => 'public', // file storage
            'delurl' => route('filedelete'), // route to file delete method that will be sent to result processor
            'afteruploadfn' => 'writeinupres',  //callback after file upload success (here it puts results in above text area)
        ]);
        break;
      case 'simple' :// simple uploader
        $uploader = UploaderHelper::init(
          'uploaderdiv', //label
          'Uploader', //label
          route('fileupload'), // route for file prodessing
          [
            'acceptable_mimes' => $acceptable,  // comma-separated list of valid extensions
            'maxfilesizek' => 1024, // max file size
            'path' => '/uploads', // folder in storage where files must be uploaded
            'storagename' => 'public', // file storage
            'filepattern' => 'test', // pattern to name files
            'rename' => true, // new name is generated if
            'multiple' => true, // multiple files can be uploaded
            'afteruploadfn' => 'writeinupres', //callback after file upload success (here it puts results in above text area)
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
        'displayinitupl-menu' => [
          'title' => 'Display file on init',
          'target' => route('uploader', ['type' => 'displayinit'])
        ],
        'functionsupl-menu' => [
          'title' => 'Upload functions',
          'target' => route('uploader', ['type' => 'functions'])
        ],
        'resprocupl-menu' => [
          'title' => 'Upload result processing',
          'target' => route('uploader', ['type' => 'resultprocessor'])
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
        'uploader2' => $uploader2,
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
