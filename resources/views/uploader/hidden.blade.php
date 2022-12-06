<h4>Hidden uploader</h4>
<p>These examples show uploader that are hidden on init.</p>
<p>In your controller create an instance of UploaderHelper and pass the variable to the view.</p>
<pre>
<code>
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
      ...
  ]);
return view('template', ['v' => $uploader, 'uploader2' => $uploader2]);
</code>
</pre>
<p>Javascript code to be inserted in blade template to process
  <a href="{{ route('uploader', ['type' => 'functions'])}}">file uploade method</a>
  results:</p>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $uploader !!}</code></p>
<h4>Demo</h4>
{!! $uploader !!}
<p>Above uploader is totally hidden. <button class="btn btn-primary btn-sm" id="toggle1">Toggle display</button></p>
<br/><br/>
{!! $uploader2 !!}
<p>For second uploader, uploader is hidden but label is visible. <button class="btn btn-primary btn-sm" id="toggle2">Toggle display</button></p>
<script type="text/javascript">
jQuery('#toggle1').on('click', function(){ {!! $uploader->toggleall() !!} });
jQuery('#toggle2').on('click', function(){ {!! $uploader2->toggleall() !!} });
</script>
