<?php

namespace App\Http\Controllers;

use App\Http\Requests\Fileupload2Request;
use Seblhaire\Uploader\FileuploadRequest;
use Illuminate\Support\Facades\Storage;
use Seblhaire\Uploader\UploaderTrait;
use Illuminate\Http\Request;

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
      $errors = [];
      foreach ($request->file('file') as $file){
        if (!$file->isValid()) { // file upload failed
          $errors[] = 'invalid file ' . $file->getClientOriginalName();
          continue;
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
        if ($request->input('rename')){
            $filename = $this->buildUniqueFileName($disk, $path, $destfile);
        }else{ // file cam be overwritten
            $filename = $destfile->name . '.' . $destfile->ext;
            if (Storage::disk($disk)->exists($path . $filename)){
              $errors[] = 'file exists ' . $filename;
              continue;
            }
        }
        // store file in destination directoty
        $filepath = $file->storeAs($path, $filename, $disk);
        $files[] = [
          'filename' => $filename,
          'filepath' => $filepath,
          'ext' => $fileobj->ext,
          'mimetype' => $file->getMimeType(),
          'size' =>  $file->getSize(),
        ];
      }
      if (count($errors)){
        $message = implode(', ',  $errors);
        if (count($files) > 0){
          foreach ($files as $file){
            Storage::disk($disk)->delete($file['filepath']);
          }
        }
        return response()->json([
          'ok' => false,
          'message' => $message
        ]);
      }else{
        foreach ($files as $i => $file){

          // Here you could store file info in a database table.

          $files[$i]['file_id'] = random_int(1, 10000);
        }
        return response()->json([
          'ok' => true,
          'info' => [
            'filepath' => $path,
            'disk' => $disk,
            'baseurl' => !is_null(config('filesystems.disks.' . $disk . '.url')) ?  (config('filesystems.disks.' . $disk . '.url') . $path) : '',
          ],
          'files' => $files,
          // other parameters you need can be
        ]);
      }
  }


  public function processFile(Fileupload2Request $request)
  {
    $validated = $request->validated();
    $path = $this->getPath($request);
    $disk = $this->getDisk($request, $path);
    $files = [];
    $errors = [];
    foreach ($request->file('file') as $file){
      if (!$file->isValid()) { // file upload failed
        $errors[] = 'invalid file ' . $file->getClientOriginalName();
        continue;
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
      if ($request->input('rename')){
          $filename = $this->buildUniqueFileName($disk, $path, $destfile);
      }else{ // file cam be overwritten
          $filename = $destfile->name . '.' . $destfile->ext;
          if (Storage::disk($disk)->exists($path . $filename)){
            $errors[] = 'file exists ' . $filename;
            continue;
          }
      }
      // store file in destination directoty
      $filepath = $file->storeAs($path, $filename, $disk);
      $files[] = [
        'filename' => $filename,
        'filepath' => $filepath,
        'ext' => $fileobj->ext,
        'mimetype' => $file->getMimeType(),
        'size' =>  $file->getSize(),
      ];
    }
    if (count($errors)){
      $message = implode(', ',  $errors);
      if (count($files) > 0){
        foreach ($files as $file){
          Storage::disk($disk)->delete($file['filepath']);
        }
      }
      return response()->json([
        'ok' => false,
        'message' => $message
      ]);
    }else{
      foreach ($files as $i => $file){

        // Here you could store file info in a database table.

        $files[$i]['file_id'] = random_int(1, 10000);
      }
      return response()->json([
        'ok' => true,
        'info' => [
          'filepath' => $path,
          'disk' => $disk,
          'baseurl' => !is_null(config('filesystems.disks.' . $disk . '.url')) ?  (config('filesystems.disks.' . $disk . '.url') . $path) : '',
        ],
        'files' => $files,
      ]);
    }
  }

  public function delete(Request $request){
    $this->validate($request, ['id' => 'required|numeric']);
    /*$file = File::find($request->input('id'));
    if (is_null($file)) throw new Exception('file not found');
    Storage::disk('public')->delete($file->path);
    $file->delete();*/
    return response()->json(['ok' => true]);
  }
}
