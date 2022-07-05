<h4>Upload functions</h4>
<p>Package contains utilities that help define file upload functions quickly.
It uses Laravel file storages and form validator.</p>
<h5>File upload request</h5>
<p><code>Seblhaire\Uploader\FileuploadRequest</code> is a Laravel form Request
that contain form validation rules that can be used to validate values returned by
our file upload component, namely file size and file type. Use it as follows:</p>
<pre>
<code>
public function index(FileuploadRequest $request){ // process uploaded file
    $validated = $request->validated();
    ...
}
</code>
</pre>
<h5>UploaderTrait</h5>
<p><code>Seblhaire\Uploader\UploaderTrait</code> is a trait that can be used by your
file upload controller.</p>
<ul>
  <li><code>buildFileObj($filename)</code> builds an object which contains file
    name and file extension.</li>
  <li><code>buildUniqueFileName($disk, $path, $fileobj, $separator = '-')</code>
    verifies if a file already exists in destination path and builds an unique
    filename.</li>
  <li><code>cleanFileName($filename)</code> removes accentuated characters and
    white spaces from file name.</li>
  <li><code>getPath($request)</code> returns a string that contains file path
    defined from default
    config files or from uploader parameters.</li>
  <li><code>getDisk($request, $path)</code> returns storage name either from default
    config file or from uploder parameters; if needed, it creates destination
    directory from path.</li>
</ul>
<h5>Upload controller</h5>
<p>Here is a file upload controller that you can use as is or adapt to your needs.</p>
<pre>
<code>
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
        'baseurl' => !is_null(config('filesystems.disks.' . $disk . '.url')) ?
            (config('filesystems.disks.' . $disk . '.url') . $path) : '',
        'files' => $files,
        // other parameters you need can be
      ]);
  }
}
</code>
</pre>
