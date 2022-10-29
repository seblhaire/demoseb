<h4>Upload result processing</h4>
<p>The uploader class sends results either to a result processor or to an error
function which displays the error message. The default error function displays
messages in an alert div. You can write your own error display function and
set value <code>errorfn</code> in config file. The error function must have only one parameter
which contains the error message.</p>
<p>The result processor is a class which can be extended and defined in uploader parameter <code>resultprocessor</code>.
  Class <code>UploadresultProcessor</code> in file <code>upload.js</code> processes uploader files and build one or more file containers.</p>
<ul>
  <li><code>init(uploader)</code> inits the result processor and links it with the uploader instance in the class property <code>uploader</code>.</li>
  <li><code>buildresdiv(id, myclass)</code> builds a <code>&lt;div&gt;</code> to contain file list.</li>
  <li><code>process(res)</code> takes result of the <a href="<?= route('uploader', ['type' => 'functions']) ?>">upload function</a> and builds instance(s) of
    file container class (see above); it also stores a file list in class property <code>filelist</code>.</li>
  <li><code>countFiles()</code> counts files in class property <code>filelist</code>. This information can be used by form validation.</li>
  <li><code>removefile(pos)</code> removes files from list in <code>pos</code> position.</li>
</ul>
<p>Files are displayed in <code>&lt;div&gt;</code> instances which are built by <code>UploadedFileContainer</code> or other similar classes. The class name is
  defined in  uploader parameter <code>filecontainer</code>. File container classes must have 2 methods:</p>
  <ul>
    <li><code>init(processor)</code> inits the file container and links it with the result processor instance in the class property <code>processor</code>
      (and therefore to the uploader); property <code>idx</code> contains index of file position in result processor file list, used when you delete files.</li>
    <li><code>build(file, info)</code> builds a <code>&lt;div&gt;</code> to contain file. Parameter <code>file</code> contains file information returned by file
      upload route; parameter <code>info</code> contains general information returned by file processor.</li>
  </ul>
<p>In above mentionned class, we also provide the useful method <code>buildurl(file, info)</code>, which returns complete file URL and can be used in another class
  that extends that basic class. Rules are following:</p>
<ul>
<li>If the file object returned by file upload route contains a parameter <code>url</code>, we return this value.</li>
<li>If general information in parameter <code>info</code> contains a <code>baseurl</code> value, we build the file url with this value..</li>
<li>If property <code>baseurl</code> is defined in file processor instance, we build the file url with this value..</li>
<li>If option <code>baseurl</code> is defined in uploader parameters, we build the file url with this value..</li>
</ul>
<p>Next to this very basic class, we also provide class <code>UploadedFileContainerExt</code> in file <code>uploaderResult.js</code> which builds a
  <code>&lt;div&gt;</code> with a thumbnail describing file type (file icon or image thumbnail), file information and two buttons, one to copy file url and the other
  to delete file by calling route defined in uploader parameter <code>delurl</code> and removing file in file result container <code>filelist</code>.</p>
