@extends('layout')

@section('title', $title)
@section('content')
<h1>Uploader</h1>
<p class="lead">A Laravel library to provide file upload utilities. A Javascript library builds a
  complete file upload widget with upload button, drag-and-drop zone, progress bar
  and result builder. A controller is available to manage uploaded files.
  <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/uploader">Project on GitHub</a>.
  <a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/uploader">Project on Packagist</a>.
  This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.
</p>
<p>On this site, you can only upload files up to {{ $maxsize }} and having extensions {{ $extensions }}.
  Files will be destroyed after {{ $filelife }} minutes.</p>
<h2>Simple uploader</h2>
<p>This uploader simply uploads files and then displays result in an alert div.</p>
{!! $uploader !!}
<h2>Basic uploader without drag and drop</h2>
<p>Same settings as previous example, but drag and drop disabled.</p>
{!! $uploader2 !!}
<h2>Complete uploader</h2>
<p>This uploader uses a result plugin which displays results in a nice list. After file upload, files are submitted to a second
route, which could eg. register file in database.</p>
{!! $uploader3 !!}
<h2>Hidden uploader</h2>
<p>This last example shows an uploader which uploads a single file. When a file has been uploaded, uploader is hidden.
In this example, we show a file already uploaded into website. This file could be retrieved from database by an Ajax script.
Then you can delete file  - the uploader is shown again - and upload a new file.</p>
{!! $uploader4 !!}
<script type="text/javascript">
/* extends basic result object*/
UploaderResult = {
  baseurl: '{!! asset("storage/uploads")!!}/',
  process: function(result){// sends data to second uploader
    if (result.ok){
      var self = this;
      jQuery.ajax({
        url: '{!! route('processfile')!!}',
        type: 'POST',
        dataType :'json',
        data: result,
      })
      .done(function(res){
        self.preparedisplay(res);
      });
    } else {
      this.uploader.notify(
        this.uploader.options.alerterrorclass,
        result.message
      );
    }
  },
  setbaseurl: function(url){
    this.baseurl = url;
  },
  preparedisplay: function(res){ //prepares data to diplay in result div
    var url = this.baseurl + res.filename;
    var thumb = this.dothumbnail(res.ext, url);
    var btn = jQuery('<button></button>')
       .html('Copy')
       .addClass('btn btn-outline-primary btn-sm copybtn')
       .attr('id', res.pseudo_file_id + '_id')
       .attr('data-clipboard-text', url);
    var content = jQuery('<div></div>')
        .append(jQuery('<h5></h5').addClass('mt-0 mb-1').html(res.filename))
        .append(
          jQuery('<p></p')
              .html('pseudo file id: ' + res.pseudo_file_id + ' ')
              .append(btn)
        );
    this.addfiletolist(thumb, content);
  }
}
// extend base result object
UploaderResult = jQuery.extend({}, UploadresultProcessor, UploaderResult);

UploaderResult2 = {
  baseurl: '{!! asset("img")!!}/',
  process: function(result){ //sends data to result builder
    if (result.ok){
      this.preparedisplay(result);
    } else {
      this.uploader.notify(
        this.uploader.options.alerterrorclass,
        result.message
      );
    }
  },
  setbaseurl: function(url){
    this.baseurl = url;
  },
  preparedisplay: function(res){ //prepares data to diplay in result div
    var url = this.baseurl + res.filename;
    var thumb = this.dothumbnail(res.ext, url);
    var btn = jQuery('<button></button>')
       .html('Delete')
       .addClass('btn btn-outline-primary btn-sm')
       .attr('id', res.pseudo_file_id + '_id')
       .on('click', {obj: this}, function(e){
         e.data.obj.uploader.div.show();
         jQuery(this).parents('li').remove();
       });
    var content = jQuery('<div></div>')
        .append(jQuery('<h5></h5').addClass('mt-0 mb-1').html(res.filename))
        .append(btn);
    this.addfiletolist(thumb, content);
    this.uploader.div.hide();
  }
}
UploaderResult2 = jQuery.extend({}, UploadresultProcessor, UploaderResult2);
/* adds copy function to buttons that have copybth class */
new Clipboard('.copybtn', {
    text: function(trigger) {
        return $(trigger).attr('data-clipboard-text');
    }
});
jQuery(document).ready(function(){
  // set uploaders after page is completely loaded
  {!! $uploader->setpath('/uploads') .
  $uploader->setstoragename('public'); !!}
  {!! $uploader2->setpath('/uploads') .
  $uploader2->setstoragename('public'); !!}
  {!! $uploader3->setpath('/uploads') .
  $uploader3->setstoragename('public'); !!}
  {!! $uploader4->setpath('/uploads') .
  $uploader4->setstoragename('public'); !!}

  // insert an exampla file in hidden uploader result div
  var proc = {!! $uploader4->getresultprocessor() !!}
  proc.preparedisplay({filename: 'seb.jpg', ext: 'jpg'});
});
</script>
@endsection
