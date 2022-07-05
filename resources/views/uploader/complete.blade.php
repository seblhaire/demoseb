<h4>Complete uploader</h4>
<p>This uploader uses a result plugin which displays results in a nice list.
File name is changed automatically and files cannot be overwritten, i.e. a new file name
is generated. All you need to know about file processing
available <a href="{{ route('uploader', ['type' => 'functions'])}}">here</a>.
</p>
<p>In your controller create an instance of UploaderHelper and pass the variable to the view.</p>
<pre>
<code>
$uploader = UploaderHelper::init(
  'uploaderdiv3', //uploader id
  'Uploader',//label
  route('fileupload2'), // route for file prodessing
  [
    'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
    'resultclass' => 'UploaderResult', // class of object containing files list
    'multiple' => true, // multiple files can be uploaded
    'acceptable_mimes' => 'png,jpg,jpeg,gif,txt',  // comma-separated list of valid extensions
  ], [ // additional parameters transmitted to upload script
    'article_title' => "l'ami",
    'article_id' => 40
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
    // set uploader values in page instead of on init object
    {!! $uploader->setpath('/uploads') !!}
    {!! $uploader->setstoragename('public'); !!} // file storage name, see Laravel doc
    {!! $uploader->setfilepattern('toto') !!} // file pattern to automatic file name build
    {!! $uploader->setmaxsize(1024) !!}
    {!! $uploader->setmimes('jpg,png,gif') !!}
  	{!! $uploader->setoverwrite(false) !!} // file will note be overwritten if exists but a new
                                       // file name will be generated
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
  // set uploader values in page  instead of on init object
  {!! $uploader->setpath('/uploads') !!}
  {!! $uploader->setstoragename('public'); !!}
  {!! $uploader->setfilepattern('toto') !!} // file pattern to automatic file name build
  {!! $uploader->setmaxsize(1024) !!}
  {!! $uploader->setmimes('jpg,png,gif') !!}
	{!! $uploader->setoverwrite(false) !!} // file will note be overwritten if exists but a new
                                     // file name will be generated
});
</script>
