<?php

namespace App\Http\Controllers;

use App\Http\Requests\Fileupload2Request;
use Seblhaire\Uploader\FileuploadRequest;
use Illuminate\Support\Facades\Storage;
use Seblhaire\Uploader\UploaderTrait;

class FileUploadController extends Controller
{
  use UploaderTrait; //provides functions to help interact with Uploader objects

  public function index(FileuploadRequest $request){ // process uploaded file
      $validated = $request->validated();
      // define storage and path parameters
      $path = $this->getPath($request);
      $disk = $this->getDisk($request, $path);
      $files = [];
      // process files
      foreach ($request->file('file') as $file){
        if (!$file->isValid()) { // file upload failed
          response()->json([
            'ok' => false,
            'message' => 'invalid file ' . $file->getClientOriginalName()
          ]);
        }
        // gets object with file info
        $fileobj = $this->buildFileObj($this->cleanFileName($file->getClientOriginalName()));
        // if a file pattern has been set to replace original filename, build
        // another file object
        if ($request->has('filepattern') && strlen($request->input('filepattern')) > 0){
          $patternobj = $this->buildFileObj($request->input('filepattern'));
        }else{
          $patternobj = null;
        }
        if (!is_null($patternobj)){
          $destfile = $patternobj;
          if ($patternobj->ext == ''){
            $destfile->ext = $fileobj->ext;
          }
        }else{
          $destfile = $fileobj;
        }
        // if file can't be overwitten, build unique file name
        if (!$request->input('overwrite')){
            $filename = $this->buildUniqueFileName($disk, $path, $destfile);
        }else{ // file cam be overwritten
            $filename = $destfile->name . '.' . $destfile->ext;
        }
        // store file in destination directoty
        $filepath = $file->storeAs($path, $filename, $disk);
        $files[] = [
          'filename' => $filename,
          'ext' => $fileobj->ext,
          'mimetype' => $file->getMimeType(),
          'size' =>  $file->getSize()
        ];
        // Here you could store file info in a database table.
      }
      return response()->json([
        'ok' => true,
        'filepath' => $path,
        'disk' => $disk,
        'baseurl' => !is_null(config('filesystems.disks.' . $disk . '.url')) ?  (config('filesystems.disks.' . $disk . '.url') . $path) : '',
        'files' => $files,
        // other parameters you need can be
      ]);
  }


  public function processFile(Fileupload2Request $request)
  {
    $validated = $request->validated();
    $path = $this->getPath($request);
    $disk = $this->getDisk($request, $path);
    $files = [];
    foreach ($request->file('file') as $file){
      if (!$file->isValid()) {
        response()->json([
          'ok' => false,
          'message' => 'invalid file ' . $file->getClientOriginalName()
        ]);
      }
      $fileobj = $this->buildFileObj($this->cleanFileName($file->getClientOriginalName()));
      if ($request->has('filepattern') && strlen($request->input('filepattern')) > 0){
        $patternobj = $this->buildFileObj($request->input('filepattern'));
      }else{
        $patternobj = null;
      }
      if (!is_null($patternobj)){
        $destfile = $patternobj;
        if ($patternobj->ext == ''){
          $destfile->ext = $fileobj->ext;
        }
      }else{
        $destfile = $fileobj;
      }
      if (!$request->input('overwrite')){
          $filename = $this->buildUniqueFileName($disk, $path, $destfile);
      }else{
          $filename = $destfile->name . '.' . $destfile->ext;
      }
      $filepath = $file->storeAs($path, $filename, $disk);
      /*
      here you could / should register your file into database or whatever you need
      instead of this dummy function
      */
      $files[] = [
        'filename' => $filename,
        'ext' => $fileobj->ext,
        'mimetype' => $file->getMimeType(),
        'size' =>  $file->getSize(),
        'pseudo_file_id' => random_int(1, PHP_INT_MAX)
      ];
    }
    return response()->json([
      'ok' => true,
      'filepath' => $path,
      'files' => $files,
      'disk' => $disk,
      'baseurl' => !is_null(config('filesystems.disks.' . $disk . '.url')) ?  (config('filesystems.disks.' . $disk . '.url') . $path) : '',
    ]);
  }
}
