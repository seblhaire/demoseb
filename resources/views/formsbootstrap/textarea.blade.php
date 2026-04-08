<h3>Textarea</h3>
<br/>
{!! Form::bsOpen(['id' => 'form_textarea', 'action' => route('formsbootstrap_processform'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsTextarea(['id' => 'text', 'labeltext' => 'Text']); !!}
{!! Form::bsClose() !!}
@include('formsbootstrap.result')
<br/><br/>
<h4>Implementation</h4>
<pre><code>
@{!! Form::bsTextarea(['
  id' => 'text', // field id and name
  'labeltext' => 'Text' // field label
]); !!}
</code></pre>
<p>Output:<br/><code>
{!! nl2br(htmlspecialchars(Form::bsTextarea(['id' => 'text', 'labeltext' => 'Text']))) !!}
</code></p>