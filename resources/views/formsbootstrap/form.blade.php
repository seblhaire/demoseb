<h3>Form</h3>
<pre><code>
@{!! Form::bsOpen([
  'id' => 'form_form', //form id
  'action' => route('formsbootstrap_processform') //url where form is submitted to
]) !!}
&lt;div class="col-auto"&gt;
@{!! Form::bsSubmit([]) !!}
@{!! Form::bsButton(['id' => 'cancel', 'action' => 'alert("cancel clicked");', 'label' => 'Cancel']) !!}
&lt;/div&gt;
@{!! Form::bsClose() !!}
&lt;div class="col-auto"&gt;
</code></pre>
<p>Output:<br/><code>
{!! nl2br(htmlspecialchars(Form::bsOpen(['id' => 'form_form', 'action' => route('formsbootstrap_processform')]))) !!}
&lt;div class="col-auto"&gt;<br/>
{!! nl2br(htmlspecialchars(Form::bsSubmit([]))) !!}
{!! nl2br(htmlspecialchars(Form::bsButton(['id' => 'cancel', 'label' => 'Cancel']))) !!}
&lt;/div&gt;<br/>
{!! htmlspecialchars(Form::bsClose()) !!}
</code><br/>
NB: some attributes are automaticallly added to tag and hidden input with CSRF token is generated.
</p>
<br/><br/>
<div class="col-auto">
{!! Form::bsSubmit([]) !!}&nbsp;
{!! Form::bsButton(['id' => 'cancel', 'action' => 'alert("cancel clicked");', 'label' => 'Cancel']) !!}
</div>
<br><br>
