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
    'resultclass' => 'UploaderResult',
    'acceptable_mimes' => $acceptable,  // comma-separated list of valid extensions
    'maxfilesizek' => 1024, // max file size
    'multiple' => true, // multiple files can be uploaded
    'path' => '/uploads', // folder in storage where files must be uploaded
    'storagename' => 'public', // file storage name, see Laravel doc
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
  /* extends basic result object*/
  UploaderResult = {
    baseurl: null,
    process: function(result){// sends data to second UploaderResult
      if (result.ok){
        var self = this;
        self.baseurl = result.baseurl; //retrieve base url from ajax result
        jQuery.each(result.files, function(i, file) {
          self.preparedisplay(file, i);
        });
      } else { // display error
        this.uploader.notify(
          this.uploader.options.alerterrorclass,
          result.message
        );
      }
    },
    preparedisplay: function(res, i){ //prepares data to diplay in result div
      var url = this.baseurl + res.filename; // builds complete url.
      var thumb = this.dothumbnail(res.ext, url); // build image thumbnail or insert file icpm
      var id = this.uploader.divid;
      if (res.pseudo_file_id !=  undefined){
        id += '_' + res.pseudo_file_id;
      }else{
        id += '_' + i;
      }
      // copy button
      var cpbtn = jQuery('&lt;i&gt;&lt;/i&gt;')
         .attr('title', 'Copy')
         .addClass('far fa-copy uploaderresultbtn copybtn')
         .attr('id', id + '_copy')
         .attr('data-clipboard-text', url);
      //delete button
      var delbtn = jQuery('&lt;i&gt;&lt;/i&gt;')
            .attr('title', 'Delete')
            .addClass('far fa-trash-alt uploaderresultbtn')
            .attr('id', id + '_del')
            .on('click', {obj: this}, function(e){
              e.data.obj.uploader.uploaddiv.show();
              //here yiu shoud call an ajax script to delete file
              jQuery(this).parents('div.uploadres').remove();
            });
      var p = jQuery('&lt;p&gt;&lt;/p&gt;');
      if (res.pseudo_file_id !=  undefined){
        p.html('pseudo file id: ' + res.pseudo_file_id);
      }
      p.append(cpbtn)
          .append(delbtn)
      var content = jQuery('&lt;div&gt;&lt;/div&gt;')
          .append(jQuery('&lt;h5&gt;&lt;/h5&gt;').addClass('mt-0 mb-1').html(res.filename))
          .append(p);
      this.addfiletolist(thumb, content); // display file in list
    }
  }
  // extend base result object
  UploaderResult = jQuery.extend({}, UploadresultProcessor, UploaderResult);
  /* adds copy function to buttons that have copybth class */
  new Clipboard('.copybtn', {
      text: function(trigger) {
          return jQuery(trigger).attr('data-clipboard-text');
      }
  });

  jQuery(document).ready(function(){
    // insert an exampla file in hidden uploader result div
      var proc = {!! $uploader->getresultprocessor() !!}
      proc.baseurl = '{{ asset("img")}}/';
      proc.preparedisplay({filename: "seb.jpg", ext: "jpg"}, 1);
  });
&lt;/script&gt;
</code>
</pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $element !!}</code></p>
<h4>Demo</h4>
{!! $uploader !!}
<script type="text/javascript">
/* extends basic result object*/
UploaderResult = {
  baseurl: null,
  process: function(result){// sends data to second UploaderResult
    if (result.ok){
      var self = this;
      self.baseurl = result.baseurl; //retrieve base url from ajax result
      jQuery.each(result.files, function(i, file) {
        self.preparedisplay(file, i);
      });
    } else { // display error
      this.uploader.notify(
        this.uploader.options.alerterrorclass,
        result.message
      );
    }
  },
  preparedisplay: function(res, i){ //prepares data to diplay in result div
    var url = this.baseurl + res.filename; // builds complete url.
    var thumb = this.dothumbnail(res.ext, url); // build image thumbnail or insert file icpm
    var id = this.uploader.divid;
    if (res.pseudo_file_id !=  undefined){
      id += '_' + res.pseudo_file_id;
    }else{
      id += '_' + i;
    }
    // copy button
    var cpbtn = jQuery('<i></i>')
       .attr('title', 'Copy')
       .addClass('far fa-copy uploaderresultbtn copybtn')
       .attr('id', id + '_copy')
       .attr('data-clipboard-text', url);
    //delete button
    var delbtn = jQuery('<i></i>')
          .attr('title', 'Delete')
          .addClass('far fa-trash-alt uploaderresultbtn')
          .attr('id', id + '_del')
          .on('click', {obj: this}, function(e){
            e.data.obj.uploader.uploaddiv.show();
            //here yiu shoud call an ajax script to delete file
            jQuery(this).parents('div.uploadres').remove();
          });
    var p = jQuery('<p></p>');
    if (res.pseudo_file_id !=  undefined){
      p.html('pseudo file id: ' + res.pseudo_file_id);
    }
    p.append(cpbtn)
        .append(delbtn)
    var content = jQuery('<div></div>')
        .append(jQuery('<h5></h5>').addClass('mt-0 mb-1').html(res.filename))
        .append(p);
    this.addfiletolist(thumb, content); // display file in list
  }
}
// extend base result object
UploaderResult = jQuery.extend({}, UploadresultProcessor, UploaderResult);
/* adds copy function to buttons that have copybth class */
new Clipboard('.copybtn', {
    text: function(trigger) {
        return jQuery(trigger).attr('data-clipboard-text');
    }
});

jQuery(document).ready(function(){
  // insert an exampla file in hidden uploader result div
    var proc = {!! $uploader->getresultprocessor() !!}
    proc.baseurl = '{{ asset("img")}}/';
    proc.preparedisplay({filename: "seb.png", ext: "png"}, 1);
});
</script>
