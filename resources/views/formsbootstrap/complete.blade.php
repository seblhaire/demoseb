{!! Form::bsOpen([
  'id' => 'form_complete',
  'action' => route('formsbootstrap_processform'),
  'csrfrefreshroute' => route('refreshcsrf'),
  'ajaxcallback' => 'processform',
  'filldatacallback' => 'datafill'
]) !!}
<h3>Complete example</h3>
<p>In the code, some values are printed with Javascript command <code>console.log(data)</code>. Open developper console with <kbd>F12</kbd>, then click tab "Console"</p>
{!! Form::hidden('main_id', 0, ['id' => 'main_id']);!!}
{!! Form::bsText(['id' => 'title', 'labeltext' => 'Title', 'required' => true]); !!}
{!! Form::bsEmail(); !!}
{!! Form::bsEditor(['id' => 'article','required' => true,'labeltext' => 'Article']); !!}
{!! Form::bsNumber(['id' => 'weight', 'labeltext' => 'Article weight', 'value'=> "5", 'attributes' => ['min' => 0, 'max' => 10], 'helptext' => 'Please enter a number between 0 and 10','required' => true]); !!}
{!! $countries !!}
{!! Form::hidden('countrylist', '', ['id' => 'countrylist']);!!}
{!! $cal->output() !!}
{!! Form::bsSelect(['name' => 'priority', 'labeltext' => 'Priority',
'values' => ['lowest' => 'Lowest','low' => 'Low','medium' => 'Medium','high' => 'High','highest' => 'Highest'], 'default' => 'medium']) !!}
{!! Form::bsRadio(['name' => 'publish', 'values' => ['yes' => 'Yes','no' => 'No'], 'checkedvalue' => 'yes', 'mainlabel' => 'Publish']) !!}
{!! Form::bsCheckbox(['name' => 'languages',
'values' => ['en' => 'English', 'fr' => 'Français', 'de' => 'Deutsch', 'it' => 'Italiano', 'es' => 'Español',
'pt' => 'Português'], 'mainlabel' => 'Languages', 'switch' => true, 'required' => true]) !!}
{!! Form::bsSelect(['name' => 'os', 'labeltext' => 'Operating system',
'values' => ['mac' => 'MacOs','windows' => 'Windows', 'linux' => 'Linux', 'vms' => 'Vms','unix' => 'Unix'],
'default' => 'linux', 'multiple' => true, 'required' => true]) !!}
{!! $cal2->output() !!}
{!! $uploader !!}
{!! Form::bsRange(['id' => 'range', 'labeltext' => 'Range', 'min' => 0, 'max' => 10, 'value' => "3", 'required' => true]); !!}
{!! Form::bsColorpicker(['id' => 'color', 'labeltext' => 'Color', 'value' => '#ff0000']) !!}
{!! Form::bsTextarea(['id' => 'notes', 'labeltext' =>  'Notes', 'required' => true]); !!}
{!! Form::bsSubmit(['id' => 'sendart', 'label' => 'Submit']) !!}
{!! Form::bsButton(['id' => 'cancelBtn', 'label' => 'Clear form',  'action' => "jQuery('#form_complete').data('sebformhelper').reset()"]) !!}
{!! Form::bsClose() !!}
<br/>
<button id="filldata" class="btn btn-warning" type="button">Fill form with example data</button>
<script>
var setCountry = function(tag, data, object){ // callback for tag add and removal
	jQuery('#countrylist').val(object.getCommaSepValues());
}

UploaderResult = { // class to process uploader results
  baseurl: null,
  uniqueid: 0,
  process: function(result){// sends data to second UploaderResults
    if (result.ok){
      var self = this;
      self.baseurl = result.baseurl;
      jQuery.each(result.files, function(i, file) {
        self.preparedisplay(file, i);
      });
    } else {
      this.uploader.notify(
        this.uploader.options.alerterrorclass,
        result.message
      );
    }
  },
  preparedisplay: function(res, i){ //prepares data to diplay in result div
    var url = this.baseurl + res.filename;
    var thumb = this.dothumbnail(res.ext, url);
    var id = this.uploader.divid;
    var returnval = null;
    if (res.pseudo_file_id !=  undefined){
      id += '_' + res.pseudo_file_id;
      returnval = res.pseudo_file_id;
    }else{
      id += '_' + this.uniqueid;
      returnval = this.uniqueid;
    }
    var cpbtn = jQuery('<i></i>')
       .attr('title', 'Copy')
       .addClass('far fa-copy uploaderresultbtn copybtn')
       .attr('id', id + '_copy')
       .attr('data-clipboard-text', url);
    var delbtn = jQuery('<i></i>')
          .attr('title', 'Delete')
          .addClass('far fa-trash-alt uploaderresultbtn')
          .attr('id', id + '_del')
          .on('click', {obj: this}, function(e){
            e.data.obj.uploader.uploaddiv.show();
            //here yiu shoud call an ajax script to delete file
            jQuery(this).parents('div.uploadres').remove();
          });
    var p = jQuery('<p></p');
    if (res.pseudo_file_id !=  undefined){
      p.html('pseudo file id: ' + res.pseudo_file_id);
    }
    p.append(cpbtn)
        .append(delbtn)
    var input = jQuery('<input/>')
          .attr('type', 'hidden')
          .attr('name', this.uploader.divid + '[' + this.uniqueid + ']')
          .val(returnval);
    var content = jQuery('<div></div>')
        .append(input)
        .append(jQuery('<h5></h5').addClass('mt-0 mb-1').html(res.filename))
        .append(p);
    this.addfiletolist(thumb, content);
    this.uniqueid ++;
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

var datafill = function(res){ //callback value when form data is filled with data provided by ajax script, cf below
  console.log(res);
}
jQuery('#filldata').on('click', function(){ // ajax script to generate data to fill form fields
  jQuery.ajax({
    url: '{!! route("formsbootstrap_filldata") !!}',
    encoding: 'utf8',
    type: 'post',
    dataType: 'json',
    cache: false,
    headers: {
      'X-CSRF-Token': '{!! csrf_token() !!}'
    }
  })
  .done(function(res){
    if (res.ok){
      jQuery('#form_complete').data('sebformhelper').fillwithdata(res.data); //automatically fill form with results
    }
  });
});
</script>
