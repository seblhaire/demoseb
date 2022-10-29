<h4>Simple uploader without drag and drop</h4>
<p>This example has drag and drop disabled. Button is hidden after a while
since users can only upload a single file. All you need to know about file processing
available <a href="{{ route('uploader', ['type' => 'functions'])}}">here</a>.</p>
<p>In your controller create an instance of UploaderHelper and pass the variable to the view.</p>
<pre>
<code>
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
    'afteruploadfn' => 'writeinupres',  //callback after file upload success (here it puts results in above text area)
  ]
);
return view('template', ['uploader' => $uploader]);
</code>
</pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $element !!}</code></p>
<h4>Demo</h4>
{!! $uploader !!}
