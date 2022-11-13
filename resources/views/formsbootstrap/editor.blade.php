<?php
use Seblhaire\Formsbootstrap\FormsBootstrapUtils;
?>
<h3>Editor</h3>
<script type="text/javascript">
  // assigns default init values for editor
  var editorConfig = {!! FormsBootstrapUtils::validateEditorParams([ //RichtextEdito values
	  'imageUpload' => false,
	  'fileUpload' => false,
	  'fonts' => false
  ],[ // replaces default editor labels
	  'linkText' => 'Link content'
  ]) !!};
</script>
<br/>
<pre><code>
&lt;script type="text/javascript"&gt;
// assigns default init values for editor
var editorConfig = FormsBootstrapUtils::validateEditorParams([ //RichtextEditor values
	  'imageUpload' => false,
	  'fileUpload' => false,
	  'fonts' => false
  ],[ // replaces default editor labels
	  'linkText' => 'Link content'
])
&lt;/script&gt;
@{!! Form::bsEditor([
  'id' => 'text', //id of field submitted by form
  'labeltext' => 'Text', //label
  'value' => $content, // default content displayed in editor, html code
  'configvar' => 'editorConfig' // refers to above-defined js variable
]); !!}
</code></pre>
<p>Output:<br/><code>
&lt;script type="text/javascript"&gt;<br/>
var editorConfig = {!! FormsBootstrapUtils::validateEditorParams([
  'imageUpload' => false,
  'fileUpload' => false,
  'fonts' => false
],[
  'linkText' => 'Link content'
]) !!};<br/>
&lt;/script&gt;<br/>
{!! nl2br(htmlspecialchars(Form::bsEditor(['id' => 'text', 'labeltext' => 'Text', 'value' => '...', 'configvar' => 'editorConfig']))) !!}
</code></p>
<br/>
<p>Click <a href="{!! route('menuutils', ['type' => 'editortab'])!!}">here</a> to get an example with several editors in same page, displayed in tabs.</p>
<br/>
<h4>Example</h4>
<br/>
{!! Form::bsOpen(['id' => 'form_textarea', 'action' => route('formsbootstrap_processform'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsEditor([
  'id' => 'text', //id of field submitted by form
  'labeltext' => 'Text', //label
  'value' => $content, // default content displayed in editor, html code
  'configvar' => 'editorConfig' // refers to above-defined js variable
  ]); !!}
{!! Form::bsClose() !!}
