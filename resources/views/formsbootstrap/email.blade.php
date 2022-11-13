<h3>Email input</h3>
<br/>
<pre><code>
@{!! Form::email(); !!}
@{!! Form::bsEmail([
  'id' => 'email2', //field
  'name' => 'email2', // required if different from 'email'
  'labeltext' => 'E-mail 2',
  'required' => true // value will be validated on submit
]) !!}
</code></pre>
<p>Output:<br/><code>
  {!! nl2br(htmlspecialchars(Form::bsEmail())) !!}
  {!! nl2br(htmlspecialchars(Form::bsEmail(['id' => 'email2', 'labeltext' => 'E-mail 2', 'required' => true]))) !!}
</code></p>
<br/><br/>
{!! Form::bsOpen(['id' => 'form_email', 'action' => route('formsbootstrap_processform'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsEmail(); !!}
{!! Form::bsEmail([
  'id' => 'email2', //field
  'name' => 'email2', // required if different from 'email'
  'labeltext' => 'E-mail 2',
  'required' => true // value will be validated on submit
  ]); !!}
{!! Form::bsClose() !!}
