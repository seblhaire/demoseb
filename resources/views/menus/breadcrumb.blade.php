<h4>Breadcrumb navigation</h4>
<p>Here we build a  Bootstrap breadcrumb navigation menu. In your controller, define a variable this way and pass variable to the view parameters:</p>
<pre><code>
$element = BreadcrumbUtils::init('breadcrumb-nav', //main nav id
[
  'menu' => [
    'link-9' => [
      'icon' => '&lt;i class="fas fa-home fa-lg"&gt;&lt;/i&gt;',
      'title' => 'Home',
      'target' => route('menuutils', ['type' => 'breadcrumbnav'])
    ],
    'link-10' => [
      'title' => 'Second breadcrumb',
      'target' => route('menuutils', ['type' => 'breadcrumbnav'])
    ],
    'link-11' => [
      'title' => 'Third breadcrumb'
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
