<h4>Complete uploader</h4>
<p>This uploader uses a result plugin which displays results in a nice list.
Additional parameters are added to file upload procedure, both on uploader init and with a function ttaht is called before uploading.
All you need to know about file processing
available <a href="{{ route('uploader', ['type' => 'functions'])}}">here</a>.
</p>
<p>In your controller create an instance of UploaderHelper and pass the variable to the view.</p>
<pre>
<code>
$uploader =UploaderHelper::init(
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
  ]], [ // additional parameters transmitted to upload script
    'type' => "cover",
]));
return view('template', ['uploader' => $uploader]);
</code>
</pre>
<p>Javascript code to be inserted in blade template to process
  <a href="{{ route('uploader', ['type' => 'functions'])}}">file uploader method</a>
  results:</p>
<pre>
<code>
&lt;script type="text/javascript"&gt;
   /* extends basic result object*/
   var getparams = function(){
     return {
       'time' : jQuery('#adddata').text()
     }
   }
&lt;/script&gt;
</code>
</pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $uploader !!}</code></p>
<h4>Demo</h4>
{!! $uploader !!}
<span id="adddata" style="display:none"><?= date('H:i:s') ?></span>
<script type="text/javascript">
var getparams = function(){
  return {
    'time' : jQuery('#adddata').text()
  }
}
</script>
