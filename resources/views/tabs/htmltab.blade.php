<!-- page to be inserted in main demo page-->
<h5>Tabs with HTML content</h5>
<p>Here we build tabs, where tab content is set directly in HTML code. In your controller, define a variable this way and pass variable to the view parameters:</p>
<pre><code>
$element = TabUtils::init('tabs-1', // main tab id
[
  'current' => 'tab1', // sets current ative element
  'tabs' => [ // sets tabs elements
    'tab1' => [ // array key is the tab element's id. Be sure to define an id not used elsewhere in doc
      'title' => 'Tabs 1', // label of tab element
      'content' => // tab content in HTML code
        'html code...'
    ],
    ...
  ]
]);
return view('template', ['element' => $element]);
</code></pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $element !!}</code></p>
<h4>Example</h4>
<br/>
<br/>
{!! $element !!}
<br/>
