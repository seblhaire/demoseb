<!-- page to be inserted in main demo page-->
<h5>Tabs with view content</h5>
<p>Here we build tabs, where tab content is defined by Laravel Blade templates. In your controller, define a variable this way and pass variable to the view parameters:</p>
<pre><code>
$element = TabUtils::init('tabs-2',  // main tab id
[
  'current' => 'tab5', // sets current ative element
  'tabs' => [ // sets tabs elements
    'tab5' => [ // array key is the tab element's id. Be sure to define an id not used elsewhere in doc
      'title' => 'Tabs 1', // label of tab element
      'view' => 'tabs.tabcontent', // path of blade template
      'viewparams' => [ // parameters to be passed to view
        'title' => 'Tabs 1 content',
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
<br/>
{!! $element !!}
<br/>
