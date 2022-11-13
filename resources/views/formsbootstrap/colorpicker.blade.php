<h3>Color picker</h3>
<br/>
<pre><code>
@{!! Form::bsColorpicker([
  'id' => 'color', //name and  id
  'labeltext' => 'Color',
  'value' => '#ff0000' // value of default color
]) !!}
</code></pre>
<p>Output:<br/><code>
{!! nl2br(htmlspecialchars(Form::bsColorpicker(['id' => 'color', 'labeltext' => 'Color', 'value' => '#ff0000']))) !!}
</code></p>
{!! Form::bsOpen(['id' => 'form_colorpicker', 'action' => route('formsbootstrap_processform'), 'csrfrefreshroute' => route('refreshcsrf'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsColorpicker([
  'id' => 'color', //name and  id
  'labeltext' => 'Color',
  'value' => '#ff0000' // value of default color
  ]) !!}
{!! Form::bsClose() !!}
