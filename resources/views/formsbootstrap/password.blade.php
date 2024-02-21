<h3>Password input</h3>
<h4>Single input</h4>
<p>In this example we submit two inputs to our form:</p>
<ol>
  <li>first input is required; it is submitted to form and validated by Laravel validation rules;</li>
  <li>second input is required and is validated by your browser before it is sent to the script</li>
</ol>
<p>Example 1 could be used for a login form. Characters sent to form are obfuscated. In this case, your form validation does not need verify password validation rules.
But you need validate your password if your form is used to change the password. Example 2 verifies password before it is sent to form; it should not be used for a login
form.</p>
<p>Password validation rules are following:</p>
<ul>
  <li>Password must contain min. {{ config('formsbootstrap.defaults.password_common.min_password') }} characters and max. {{ config('formsbootstrap.defaults.password_common.max_password') }} characters;</li>
  <li>Password must contain a lower case character;</li>
  <li>Password must contain an upper case character;</li>
  <li>Password must contain a number;</li>
  <li>Password must contain a symbol, like {{ config('formsbootstrap.defaults.password_common.authorized_special_chars') }}.</li>
</ul>
<p>You can easily modify theses rules. For instance, a strong password should be at least 12 characters long. To change the validation regular expression,
  we recommend the use of a online regex editor which validates rules and explains the different segments, such as
  <a href="https://regex101.com/" target="_blank" rel="noopener noreferrer">regex101.com</a>.
</p>
<pre><code>
@{!! Form::bsPassword([
  'required' => true, // password is required
  'id' => 'pass1', // field id and name
  'validate' => false //no password rules check, e.g. if used to enter user pass for identification
]) !!}
@{!! Form::bsPassword([
  'labeltext' =>'Password with validation',
  'id' => 'pass2',
  'validate' => true // password is both required and validated
]) !!}
</code></pre>
<p>Output:<br/><code>
  {!! nl2br(htmlspecialchars(Form::bsPassword(['required' => true, 'id' => 'pass1', 'validate' => false]))) !!}<br/>
  {!! nl2br(htmlspecialchars(Form::bsPassword(['labeltext' =>'Password with validation', 'id' => 'pass2', 'validate' => true]))) !!}
</code></p>
<br/><br/>
{!! Form::bsOpen(['id' => 'form_password', 'action' => route('formsbootstrap_processform'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsPassword([
  'required' => true, // password is required
  'id' => 'pass1', // field id and name
  'validate' => false //no password rules check, e.g. if used to enter user pass for identification
  ]) !!}
{!! Form::bsPassword([
  'labeltext' =>'Password with validation',
  'id' => 'pass2',
  'validate' => true // password is both required and validated
  ]) !!}
{!! Form::bsClose() !!}
<br/><br/>
<h4>Password with confirm</h4>
<p>In this example, a single function sets up a complete password change procedure.
  Old password check is optional; in the above example, password check is randomly
  true or false; therefore you may tray several time to validate form.
  You can also disable password generation
  and/or diplay password option.</p>
<pre><code>
@{!! Form::bsPasswordWithConfirm(['checkoldpassurl' => route('formsbootstrap_checkoldpass')]) !!}
</code></pre>
<p>Output:<br/><code>
{!! nl2br(htmlspecialchars(Form::bsPasswordWithConfirm(['checkoldpassurl' => route('formsbootstrap_checkoldpass')]))) !!}
</code></p>
<br/><br/>
{!! Form::bsOpen(['id' => 'form_password2', 'action' => route('formsbootstrap_processform'), 'ajaxcallback' => 'processform']) !!}
{!! Form::bsPasswordWithConfirm([
  'checkoldpassurl' => route('formsbootstrap_checkoldpass'), // route used to verify old password
  ]) !!}
{!! Form::bsClose() !!}
