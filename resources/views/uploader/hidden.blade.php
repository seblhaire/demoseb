<h4>Hidden uploader</h4>
<p>This last example shows an uploader which uploads a single file. When a file has been uploaded, uploader is hidden.
In this example, we show a file already uploaded into website. This file could be retrieved from database by an Ajax script.
Then you can delete file  - the uploader is shown again - and upload a new file.
All you need to know about file processing
available <a href="{{ route('uploader', ['type' => 'functions'])}}">here</a>.</p>
<p>In your controller create an instance of UploaderHelper and pass the variable to the view.</p>
<pre>
<code>
$uploader = UploaderHelper::init(
  'uploaderdiv4', //uploader id
  'Uploader',//label
  route('fileupload'), // route for file prodessing
  [
    'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
    'hidden' => true, // uploader is invisible when inited
    'filecontainer' => 'UploadedFileContainerExt',
    'maxfilesizek' => 1024, // max file size
    'multiple' => false, // multiple files can be uploaded
    'path' => '/uploads', // folder in storage where files must be uploaded
    'storagename' => 'public', // file storage
    'delurl' => route('filedelete'), // route to file delete method that will be sent to result processor
    'afteruploadfn' => 'writeinupres',  //callback after file upload success (here it puts results in above text area)
]);
return view('template', ['uploader' => $uploader]);
</code>
</pre>
<p>Javascript code to be inserted in blade template to process
  <a href="{{ route('uploader', ['type' => 'functions'])}}">file uploade method</a>
  results:</p>
<pre>
<code>
&lt;script type="text/javascript"&gt;
  jQuery(document).ready(function(){
    // insert an example file in hidden uploader result div
      var proc = {!! $uploader->getresultprocessor() !!}
      proc.baseurl = '{{ asset("img")}}/';
      proc.process({ok: true, files:[{filename: "seb.png", file_id: 83667, ext: "png"}]});
  });
&lt;/script&gt;
</code>
</pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $element !!}</code></p>
<h4>Demo</h4>
{!! $uploader !!}
<script type="text/javascript">
jQuery(document).ready(function(){
  // insert an exampla file in hidden uploader result div
    var proc = {!! $uploader->getresultprocessor() !!}
    proc.baseurl = '{{ asset("img")}}/';
    proc.process({ok: true, files:[{filename: "seb.png", file_id: 83667, ext: "png"}]});
});
</script>
