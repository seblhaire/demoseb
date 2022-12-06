<h4>Display file on uploader init</h4>
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
    ... no mupliple => true parameter
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
      // this has been printed by function @{!! $uploader->getresultprocessor() !!}
      proc.baseurl = '{{ asset("img")}}/';
      proc.process({ok: true, files:[{filename: "seb.png", file_id: 83667, ext: "png"}]});
  });
&lt;/script&gt;
</code>
</pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $uploader !!}</code></p>
<h4>Demo</h4>
<p>First example diplays file on init and hides uploader label.</p>
{!! $uploader !!}
<br/><br/>
<p>Second example diplays file on init and keeps label visible.</p>
{!! $uploader2 !!}
<script type="text/javascript">
jQuery(document).ready(function(){
  // insert an exampla file in hidden uploader result div
    var proc = {!! $uploader->getresultprocessor() !!}
    proc.baseurl = '{{ asset("img")}}/';
    proc.process({ok: true, files:[{filename: "seb.png", file_id: 83667, ext: "png"}]});
    var proc2 = {!! $uploader2->getresultprocessor() !!}
    proc2.baseurl = '{{ asset("img")}}/';
    proc2.process({ok: true, files:[{filename: "tablebuilder.png", file_id: 5665, ext: "png"}]});
});
</script>
