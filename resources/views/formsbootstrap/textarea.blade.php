<h3>Textarea</h3>
<br/>
<pre><code>
@{!! Form::bsTextarea(['
  id' => 'text', // field id and name
  'labeltext' => 'Text' // field label
]); !!}
</code></pre>
<p>Output:<br/><code>
{!! nl2br(htmlspecialchars(Form::bsTextarea(['id' => 'text', 'labeltext' => 'Text']))) !!}
</code></p>
<br/><br/>
{!! Form::bsOpen(['id' => 'form_textarea', 'action' => route('formsbootstrap_processform'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsTextarea(['id' => 'text', 'labeltext' => 'Text']); !!}
{!! Form::bsSubmit(['id' => 'send2', 'label' => 'Send', 'attributes' => ['class' => 'btn btn-primary']]) !!}
{!! Form::bsClose() !!}
