<h3>Checkboxes and radio buttons</h3>
<br/>
<pre><code>
@{!! Form::bsCheckbox([
  'name' => 'os', //name of checkboxes
  'values' => ['mac' => 'MacOs','windows' => 'Windows', 'linux' => 'Linux',
      'vms' => 'Vms','unix' => 'Unix'], //values of checkboxes
  'checkedvalues' => ['vms', 'mac'], // array keys of selected values
  'mainlabel' => 'Operating system' // Label for checkboxes list
]) !!}
@{!! Form::bsRadio([
  'name' => 'priority',
  'values' => ['lowest' => 'Lowest','low' => 'Low', 'medium' => 'Medium', 'high' => 'High','highest' => 'Highest'],
  'checkedvalue' => 'medium',  //since only one radio button can be selected, string value
  'mainlabel' => 'Priority'
]) !!}
@{!! Form::bsCheckbox([
  'name' => 'languages',
  'values' => ['en' => 'English', 'fr' => 'Français', 'de' => 'Deutsch', 'it' => 'Italiano',
        'es' => 'Español', 'pt' => 'Português'],
  'mainlabel' => 'Languages',
  'switch' => true, // Bootstrap switch values
  'required' => true // at least one value must be selected
]) !!}
@{!! Form::bsCheckbox([
  'name' => 'conditions',
  'values' => ['accepted' => 'I agree to terms and conditions'],
  'required' => true,
  'invalid-feedback' => "You must agree before submitting." // this message will be displayed
                                                            //if no value selected
]) !!}
</code></pre>
<p>Output:<br/><code>
{!! nl2br(htmlspecialchars(Form::bsCheckbox(['name' => 'os', 'values' => ['mac' => 'MacOs','windows' => 'Windows', 'linux' => 'Linux', 'vms' => 'Vms','unix' => 'Unix'], 'checkedvalues' => ['vms', 'mac'],'mainlabel' => 'Operating system']))) !!}
{!! nl2br(htmlspecialchars(Form::bsRadio(['name' => 'priority', 'values' => ['lowest' => 'Lowest','low' => 'Low', 'medium' => 'Medium', 'high' => 'High','highest' => 'Highest'], 'checkedvalue' => 'medium', 'mainlabel' => 'Priority']))) !!}
{!! nl2br(htmlspecialchars(Form::bsCheckbox(['name' => 'languages', 'values' => ['en' => 'English', 'fr' => 'Français', 'de' => 'Deutsch', 'it' => 'Italiano', 'es' => 'Español', 'pt' => 'Português'], 'mainlabel' => 'Languages', 'switch' => true, 'required' => true]))) !!}
{!! nl2br(htmlspecialchars(Form::bsCheckbox(['name' => 'conditions', 'values' => ['accepted' => 'I agree to terms and conditions'], 'required' => true, 'invalid-feedback' => "You must agree before submitting."]))) !!}
</code></p>
<br/><br/>
{!! Form::bsOpen(['id' => 'form_checkbox', 'action' => route('formsbootstrap_processform'), 'csrfrefreshroute' => route('refreshcsrf'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsCheckbox([
  'name' => 'os', //name of checkboxes
  'values' => ['mac' => 'MacOs','windows' => 'Windows', 'linux' => 'Linux', 'vms' => 'Vms','unix' => 'Unix'], //values of checkboxes
  'checkedvalues' => ['vms', 'mac'], // array keys of selected values
  'mainlabel' => 'Operating system' // Label for checkboxes list
  ]) !!}
{!! Form::bsRadio([
  'name' => 'priority',
  'values' => ['lowest' => 'Lowest','low' => 'Low', 'medium' => 'Medium', 'high' => 'High','highest' => 'Highest'],
  'checkedvalue' => 'medium',  //since only one radio button can be selected, string value
  'mainlabel' => 'Priority']) !!}
{!! Form::bsCheckbox([
  'name' => 'languages',
  'values' => ['en' => 'English', 'fr' => 'Français', 'de' => 'Deutsch', 'it' => 'Italiano', 'es' => 'Español', 'pt' => 'Português'],
  'mainlabel' => 'Languages',
  'switch' => true, // Bootstrap switch values
  'required' => true // at least one value must be selected
  ]) !!}
{!! Form::bsCheckbox([
  'name' => 'conditions',
  'values' => ['accepted' => 'I agree to terms and conditions'],
  'required' => true,
  'invalid-feedback' => "You must agree before submitting." // this message will be displayed if no value selected
  ]) !!}
{!! Form::bsClose() !!}
