<h3>Range</h3>
<pre><code>
@{!! Form::bsRange([
  'id' => 'range', // field id and name
  'labeltext' => 'Range', //field label
  'min' => 0, // min value
  'max' => 10, //max value
  'value' => "3", //defaut value
  'required' => true
]) !!}
</code></pre>
<p>Output:<br/><code>
{!! nl2br(htmlspecialchars(Form::bsRange(['id' => 'range', 'labeltext' => 'Range', 'min' => 0, 'max' => 10, 'value' => "3", 'required' => true]))) !!}
</code></p>
<br/><br/>
{!! Form::bsOpen(['id' => 'form_range', 'action' => route('formsbootstrap_processform'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsRange([
  'id' => 'range', // field id and name
  'labeltext' => 'Range', //field label
  'min' => 0, // min value
  'max' => 10, //max value
  'value' => "3", //defaut value
  'required' => true
  ]); !!}
{!! Form::bsSubmit(['id' => 'send', 'label' => 'Send', 'attributes' => ['class' => 'btn btn-primary']]) !!}
{!! Form::bsClose() !!}
