<h4>Simple navigation</h4>
<p>Here we build the classical Bootstrap navigation menu. In your controller, define a variable this way and pass variable to the view parameters:</p>
<pre>
<code>
$element = MenuUtils::init('simple-nav', // main nav id
[
  'current' => 'link1', // sets current ative element
  // 'ulclass' => 'nav', // this line is commented, since the value is the default one. Add other classes
                         // but make sure to keep the class "nav"
  'menu' => [ // defines the menu content
    'link1' => [ // array key is the menu element's id. Be sure to define an id not used elsewhere in doc
      'title' => 'Link 1', // label of menu element
      'target' => route('menuutils'), // route called in link
    ],
    ...
    'link3' => [
      'icon' => '&lt;i class="fa-solid fa-screwdriver-wrench"&gt;&lt;/i&gt;', // icon displayed instead of text
      'title' => 'Tools', // since an icon is set, "title" is displayed on mouse hover
      'target' => route('menuutils'),
    ],
    'link4' => [
      'title' => 'Link 4',
      'dropdown' => [ // dropdown menu replaces default target
        'link4-1' => [ // drowpdown items are defined same way as level one items
          'title' =>'Link 4.1',
          'target' => route('menuutils'),
        ],
        ...
        'sep' => null, // a separator is drawn if array value is null
      ]
    ],
  ]
]);
return view('template', ['element' => $element]);
</code>
</pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $element !!}</code></p>
<h4>Example</h4>
<br/>
{!! $element !!}
<br/>
