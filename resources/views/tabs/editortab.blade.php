<?php
use Seblhaire\Formsbootstrap\FormsBootstrapUtils;
?>
<!-- page to be inserted in main demo page-->
<h5>Tabs with editor</h5>
<p>Here we build tabs included in a form. Each tab contains two fields that are
  all sent to form processing, as you can see by clicking "send" button. Be sure
  to set different tag ids and tag names in your tabs; here we use array parameters
  to different values for each language.
  In your controller, define a variable this way and pass variable to the view
  parameters:</p>
<pre><code>
$element = TabUtils::init('editors',  // main tab id
[
  'current' => 'english', // sets current ative element
  'tabs' => [ // sets tabs elements
    'english' => [ // array key is the tab element's id. Be sure to define an id not used elsewhere in doc
      'title' => 'English', // label of tab element
      'view' => 'tabs.editors', // path of blade template
      'viewparams' => [ // parameters to be passed to view
        'titleid' => 'title-english', // title field id
        'titlefield' => 'title[english]', // title field name
        'titleval' => 'English Title', // title field content
        'editorid' => 'text-english', // editor id
        'editorfield' => 'text[english]', // editor textarea name
        'editorval' => '... html code', // content inited in editor
      ],
    ],
    ...
  ]
]);
return view('template', ['element' => $element]);
</code></pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $element !!}</code></p>
<h4>Example</h4>
<br/>
{!! Form::bsOpen(['id' => 'form_textarea', 'action' => route('formsbootstrap_processform'), 'ajaxcallback' => 'processform']) !!}
<script type="text/javascript">
// here we create a variable to set the editors. To be placed outside tabs
  var editorConfig = {!! Form::validateEditorParams() !!};
</script>
<br/>
{!! $element !!}
{!! Form::bsClose() !!}
<br/><br/>
<div id="resdiv">
  <h3>Results</h3>
  <div class="form-group">
    <label>Data sent to script</label>
    <textarea class="form-control" id="result" name="result" style="height:500px"></textarea>
  </div>
</div>
<script>
  var processform = function(data){
    oldres = jQuery('#result').val() + (jQuery('#result').val() != '' ? "\n\n" : "");
    jQuery('#result').val(oldres + data.formcontent);
    return data.message;
  };
</script>
