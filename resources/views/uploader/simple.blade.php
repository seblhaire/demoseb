<h4>Simple uploader</h4>
<p>This uploader simply uploads files and then displays result in a series of <code>&lt;div&gt;</code>. Files are renamed after a file pattern.
  All you need to know about file processing available <a href="{{ route('uploader', ['type' => 'functions'])}}">here</a>.</p>
<p>In your controller create an instance of UploaderHelper and pass the variable to the view.</p>
<pre>
<code>
$uploader =  UploaderHelper::init(
  'uploaderdiv', //label
  'Uploader', //label
  route('fileupload'), // route for file prodessing
  [
    'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
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
return view('template', ['uploader' => $uploader]);
</code>
</pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $uploader !!}</code></p>
<h4>Demo</h4>
{!! $uploader !!}
