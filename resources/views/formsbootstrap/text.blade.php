<h3>Text input</h3>
<br/>
<pre><code>
@{!! Form::bsText([
  'id' => 'text1', //field name and id
  'labeltext' => 'Text 1' // field label
]); !!}
@{!! Form::bsText([
  'id' => 'text2',
  'labeltext' => 'Text 2',
  'required' => true // mandatory field
]); !!}
@{!! Form::bsNumber([
  'id' => 'number',
  'labeltext' => 'Number',
  'required' => true
]); !!}
@{!! Form::bsNumber([
  'id' => 'number2',
  'labeltext' => 'Number 2',
  'value'=> 5, // init value
  'attributes' => ['min' => 0, 'max' => 10], // array of additional field attributes
  'helptext' => 'Please enter a number between 0 and 10', // help text displayed below field
  'required' => true
]); !!}
</code></pre>
<p>Output:<br/><code>
{!! nl2br(htmlspecialchars(Form::bsText(['id' => 'text1', 'labeltext' => 'Text 1']))) !!}<br/>
{!! nl2br(htmlspecialchars(Form::bsText(['id' => 'text2', 'labeltext' => 'Text 2', 'required' => true]))) !!}<br/>
{!! nl2br(htmlspecialchars(Form::bsNumber(['id' => 'number', 'labeltext' => 'Number', 'required' => true]))) !!}<br/>
{!! nl2br(htmlspecialchars(Form::bsNumber(['id' => 'number2', 'value' => 5, 'labeltext' => 'Number 2', 'attributes' => ['min' => 0, 'max' => 10], 'helptext' => 'Please enter a number between 0 and 10','required' => true]))) !!}
</code></p>
<br/><br/>
{!! Form::bsOpen(['id' => 'form_text', 'action' => route('formsbootstrap_processform'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsText(['id' => 'text1', 'labeltext' => 'Text 1']); !!}
{!! Form::bsText(['id' => 'text2', 'labeltext' => 'Text 2', 'required' => true]); !!}
{!! Form::bsNumber(['id' => 'number', 'labeltext' => 'Number', 'required' => true]); !!}
{!! Form::bsNumber(['id' => 'number2', 'labeltext' => 'Number 2', 'value' => 5, 'attributes' => ['min' => 0, 'max' => 10], 'helptext' => 'Please enter a number between 0 and 10','required' => true]); !!}
{!! Form::bsSubmit(['id' => 'send', 'label' => 'Send', 'attributes' => ['class' => 'btn btn-primary']]) !!}
{!! Form::bsClose() !!}
