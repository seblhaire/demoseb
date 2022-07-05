<h3>Hidden input</h3>
<pre><code>
@{!! Form::bsHidden([
  'id' => 'id', // field id and name
  'value' => 0 //default init value
]); !!}
</code></pre>
<p>Output:<br/><code>{!! htmlspecialchars(Form::bsHidden(['id' => 'id', 'value' => 0])) !!}</code></p>
