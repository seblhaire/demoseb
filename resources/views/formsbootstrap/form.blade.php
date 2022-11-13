<h3>Form</h3>
<pre><code>
@{!! Form::bsOpen([
  'id' => 'form_form', //form id
  'ajaxcallback' => 'processform',
  'action' => route('formsbootstrap_processform'), //url where form is submitted to
  'additionalbuttons' => [['id' => 'form_form_cancelbtn', 'class' => 'btn btn-secondary', 'value' => 'Cancel']]
]) !!}
@{!! Form::bsClose() !!}
</code></pre>
<p>Output:<br/><code>
{!! nl2br(htmlspecialchars(Form::bsOpen(['id' => 'form_form',   'ajaxcallback' => 'processform', 'action' => route('formsbootstrap_processform'),
'additionalbuttons' => [['id' => 'form_form_cancelbtn', 'class' => 'btn btn-secondary', 'value' => 'Cancel']]]))) !!}
{!! htmlspecialchars(Form::bsClose()) !!}<br/>
&lt;script type="text/javascript"&gt;
jQuery(document).ready(function(){
  jQuery('#form_form_cancelbtn').on('click', function(e){ alert("cancel clicked"); });
});
&lt;/script&gt;
</code><br/>
In this example, elements are generated and added to form. Hidden input with CSRF token is added automatically. By default, submit button is added. Here we also add
cancel button. And finally a result zone is added and used to display success message or error messages. See package documentation for details.  
</p>
<br/><br/>
{!! Form::bsOpen([
  'id' => 'form_form', //form id
  'action' => route('formsbootstrap_processform'), //url where form is submitted to
  'ajaxcallback' => 'processform',
  'additionalbuttons' => [['id' => 'form_form_cancelbtn', 'class' => 'btn btn-secondary', 'value' => 'Cancel']]
]) !!}
{!! Form::bsClose() !!}
<br><br>
<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('#form_form_cancelbtn').on('click', function(e){ alert("cancel clicked"); });
});
</script>
