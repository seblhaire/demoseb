<h3>Example 2: tags list with pre-existing tags</h3>
<p>In this example, we pre-add elements in tag list. This will be useful to update existing entries in tables. We also change default tag style by
  inserting a class name in a special field 'tagclass'.</p>
<p>In your controller create an instance of TagsinputHelper and pass the variable to the view.</p>
<pre>
<code>
$tagszone = TagsinputHelper::init(
  "tagzone2",
  'Countries',
  route('autocompletesearch'),
  [
    'id_included' => false, // id field is not added in autocompleter list result
    'csrfrefreshroute' => route('refreshcsrf') // route called if csrf token must be reloaded
  ],
  [
    'tagaddcallback' => 'showlist', // callback functions called after tag is addded
    'tagremovecallback' => 'showlist',
    'showaddbutton' => false, // add button not shown
    'tagclass' => 'bg-success', // change badge style
  ]
);
return view('template', ['tagszone' => $tagszone]);
</code></pre>
<p>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $tagszone !!}</code>.
  Callback functions have the following signature: <code>function(tag, data, object)</code>. Tags can be inserted as follows:
  <code>@{!! $tagszone->printAddToList("[{id:'CH', taglabel:'CH: Switzerland'},{id:'FR', taglabel:'FR: France'},{id:'GD', taglabel:'GD: Groland', tagclass:'bg-danger'}]")!!}</code>.
Here is the result printed in your page:</p>
<pre>
<code>
&lt;script type="text/javascript"&gt;
  jQuery(document).ready(function() {
    {!! $tagszone->printAddToList("[{id:'CH', taglabel:'CH: Switzerland'},{id:'FR', taglabel:'FR: France'},{id:'GD', taglabel:'GD: Groland', tagclass:'bg-danger'}]")!!};
  });
&lt;/script&gt;
</code>
</pre>
<form>
{!! $tagszone !!}
<h3>Results</h3>
<div class="form-group">
<label>List outputs</label>
<textarea class="form-control" id="result" name="result" style="height:500px"></textarea>
</div>
</form>
<script type="text/javascript">
  jQuery(document).ready(function() {
    {!! $tagszone->printAddToList("[{id:'CH', taglabel:'CH: Switzerland'},{id:'FR', taglabel:'FR: France'},{id:'GD', taglabel:'GD: Groland', tagclass:'bg-danger'}]")!!};
  });
</script>
