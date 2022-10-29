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
