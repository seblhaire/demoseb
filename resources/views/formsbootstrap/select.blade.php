<h3>Select</h3>
<br/>
<pre><code>
@{!! Form::bsSelect([
  'name' => 'priority', // name returned to form
  'labeltext' => 'Priority',
  'values' => ['lowest' => 'Lowest','low' => 'Low', 'medium' => 'Medium','high' => 'High','highest' => 'Highest'], //values
  'default' => 'medium' // key of default value
]) !!}
@{!! Form::bsSelect([
  'name' => 'os',
  'labeltext' => 'Operating system',
  'values' => ['mac' => 'MacOs','windows' => 'Windows', 'linux' => 'Linux', 'vms' => 'Vms','unix' => 'Unix'],
  'default' => 'linux',
  'multiple' => true // multiple values field
  'required' => true
]) !!}
</code></pre>
<p>Output:<br/><code>
{!! nl2br(htmlspecialchars(Form::bsSelect(['name' => 'priority', 'labeltext' => 'Priority', 'values' => ['lowest' => 'Lowest','low' => 'Low', 'medium' => 'Medium', 'high' => 'High','highest' => 'Highest'], 'default' => 'medium']))) !!}
{!! nl2br(htmlspecialchars(Form::bsSelect(['name' => 'os', 'labeltext' => 'Operating system', 'values' => ['mac' => 'MacOs','windows' => 'Windows', 'linux' => 'Linux', 'vms' => 'Vms','unix' => 'Unix'], 'default' => 'linux', 'multiple' => true, 'required' => true]))) !!}
</code></p>
<br/><br/>
{!! Form::bsOpen(['id' => 'form_select', 'action' => route('formsbootstrap_processform'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsSelect(['name' => 'priority', 'labeltext' => 'Priority', 'values' => ['lowest' => 'Lowest','low' => 'Low', 'medium' => 'Medium', 'high' => 'High','highest' => 'Highest'], 'default' => 'medium']) !!}
{!! Form::bsSelect(['name' => 'os', 'labeltext' => 'Operating system', 'values' => ['mac' => 'MacOs','windows' => 'Windows', 'linux' => 'Linux', 'vms' => 'Vms','unix' => 'Unix'], 'default' => 'linux', 'multiple' => true, 'required' => true]) !!}
{!! Form::bsSubmit(['id' => 'send2', 'label' => 'Send', 'attributes' => ['class' => 'btn btn-primary']]) !!}
{!! Form::bsClose() !!}
