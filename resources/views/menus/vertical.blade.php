<h4>Vertical navigation</h4>
<p>Here we build a vertical Bootstrap navigation menu. In your controller, define a variable this way and pass variable to the view parameters:</p>
<pre><code>
$element = MenuUtils::init('vertical-nav', //main nav id
[
  'ulclass' => 'nav flex-column', // main class
  'current' => 'link6', // sets current ative element
  'menu' => [ // defines the menu content
    'link5' => [  // array key is the menu element's id. Be sure to define an id not used elsewhere in doc
      'title' => 'Link 1', // label of menu element
      'target' => route('menuutils'), // route called in link
    ],
    ...
    'link8' => [
      'title' => 'Dropdown menu',
      'dropdown' => [ // dropdown menu replaces default target
        'link8-1' => [ // drowpdown items are defined same way as level one items
          'title' =>'Link 4.1',
          'target' => route('menuutils'),
        ],
        ...
      ]
    ],
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
