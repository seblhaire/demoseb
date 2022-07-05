<h4>Simple uploader</h4>
<p>This uploader simply uploads files and then displays result in an alert <code>&lt;div&gt;</code>
  that disappears after a while.  All you need to know about file processing
  available <a href="{{ route('uploader', ['type' => 'functions'])}}">here</a>.</p>
<p>In your controller create an instance of UploaderHelper and pass the variable to the view.</p>
<pre>
<code>
$uploader = UploaderHelper::init(
  'uploaderdiv', //uploader id
  'Uploader', //label
  route('fileupload'), // route for file prodessing
  [
    'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
    'acceptable_mimes' => 'png,jpg,jpeg,gif,txt', // comma-separated list of valid extensions
    'maxfilesizek' => 1024, // max file size
    'path' => '/uploads', // folder in storage where files must be uploaded
    'storagename' => 'public', // file storage name, see Laravel doc
    'overwrite' => true, // files can be overwritten, if false, new name is generated
    'multiple' => true // multiple files can be uploaded
  ]
);
return view('template', ['uploader' => $uploader]);
</code>
</pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $uploader !!}</code></p>
<h4>Demo</h4>
{!! $uploader !!}
