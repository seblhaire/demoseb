@extends('layout')

@section('title', $title)
@section('content')
<div class="row">
    <div class="col-sm-3">
      {!! $sidemenu !!}
    </div>
    <div class="col-sm-9">
    <h3>{{ $title }}</h3>
    <p class="lead">Bootstrap Paginator builds a classical paginator with page numbers
      and previous and next button and/or an alphabetical paginator with letters.
      Current version: {{ config('versions.bootstrappaginator')}}.
      <a target="_blank" rel="noopener noreferrer" href="https://github.com/seblhaire/bootstrappaginator">Project on GitHub</a>.
      <a target="_blank" rel="noopener noreferrer" href="https://packagist.org/packages/seblhaire/bootstrappaginator">Project on Packagist</a>.
      This demosite sources available <a target="_blank" rel="noopener noreferrer" href="https://github.com/seblhaire/demoseb">here</a>.
    </p>
    <p>In your controller assign a paginator to a variable and pass it to the view.</p>
<pre>
<code>
@switch($type)
@case('alpha')
$paginator = BootstrapPaginator::init(
  $alpha, // current character ('A', 'B', 'C' etc. or 'all' for all values)
  'paginator', // route name to be used
  [
    'type' => 'alpha', // sets paginator type
    'initialparam' => 'alpha', // parameter used by paginator.
            //If you use  config('bootstrappaginator.initialparam) ('initial'), no need to use parameter
    'params' => ['paginatortype' => 'alpha'] // additional parameter to build route
  ]
);
return view('mytemplate', ['paginator' => $paginator]);
@break
@case('combi')
$optionalpha = ['type' => 'alpha', 'initialparam' => 'param1', 'params' => ['paginatortype' => 'combi']];
$options = ['nbpages' => 4, 'pageparam' => 'param2', 'params' => ['paginatortype' => 'combi', 'param1' => $initial]];
$paginator = BootstrapPaginator::init($page, $route, $options);
$paginator2 = BootstrapPaginator::init($initial, $route, $optionalpha);
return view('mytemplate', ['paginator' => $paginator, 'paginator2' => $paginator2]);
@break
@default
$paginator = BootstrapPaginator::init(
  $page, // current page number
  'paginator', // route name to be used
  [
    'nbpages' => 11, // page numbers to be used in paginator (usually given by datase query)
    'pageparam' => 'param1', // parameter name to use in route for page number
          // If your route uses config('bootstrappaginator.pageparam) ('page'), you dont need to set this value
    'params' => [  // additional parameter to be used to build route
      'paginatortype' => 'classic'
    ]
  ];
);
return view('mytemplate', ['paginator' => $paginator]);
@break
@endswitch
</code>
</pre>
    <p>Then print your paginator by inserting <code>@{!! $paginator !!}</code> in your template.</p>
    <h4>Demo</h4>
    @isset($paginator2)
    {!! $paginator2 !!}
    @endisset
    {!! $paginator !!}
    <h4>{{ $title2 }}</h4>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam placerat ac massa quis condimentum. Praesent vestibulum rutrum varius. Sed in tempor elit. Morbi velit metus, varius nec aliquam id, congue malesuada tellus. Nunc efficitur ligula sed auctor bibendum. Curabitur at est erat. Quisque nibh lacus, accumsan quis urna eleifend, vehicula dictum dolor. In vitae diam at nibh commodo tempus in et justo. Ut molestie ipsum vel pretium pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut sem sapien. Praesent semper nisl sem, ut mollis mi varius a. Suspendisse tincidunt quam nisl, nec vulputate turpis pretium nec. Sed aliquam ullamcorper nisi, ut volutpat nunc tempus a. Ut malesuada fringilla rhoncus. Proin metus magna, egestas eu purus eu, vulputate venenatis neque.
</p>
<p>
Nullam leo sem, molestie sed sapien non, suscipit lobortis ligula. Donec ultricies ante diam, sed rhoncus elit imperdiet in. Nullam pulvinar viverra ipsum nec dapibus. Mauris ultrices sit amet velit id sollicitudin. Nam ac efficitur felis. Vivamus ut imperdiet ipsum. Sed lacinia justo id rutrum porttitor. Nam id magna at ex placerat consequat nec non diam. Curabitur nunc arcu, vestibulum id consectetur eget, pellentesque sit amet massa. Donec tristique lorem ac orci mattis, vel suscipit nunc egestas.
</p>
<p>
Suspendisse aliquet odio at scelerisque aliquam. Aliquam sed odio eget nulla bibendum lacinia ac ut diam. Ut eu dui vulputate, cursus massa eu, vestibulum felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse pulvinar vestibulum justo, et aliquet risus fermentum ut. Integer libero sapien, interdum id consequat eget, tempus ac velit. Etiam sodales scelerisque nisi vel volutpat. Vivamus vitae orci congue, ultricies turpis vitae, consectetur purus. Morbi placerat odio ut mauris accumsan, non blandit quam finibus. Donec ultrices nisl sed lacinia condimentum. Suspendisse fringilla mi nisi, quis venenatis purus commodo eget. Sed luctus mi quis augue molestie, non dapibus sem feugiat. Quisque hendrerit dolor aliquam purus tincidunt, at sodales nulla auctor.
</p>
<p>
Duis efficitur scelerisque sapien, in volutpat velit ultrices eu. Sed hendrerit dui eget augue ullamcorper pharetra. Donec finibus efficitur neque, vel ultrices erat faucibus quis. Fusce urna ante, rutrum et turpis ac, auctor iaculis libero. Duis sed porttitor ex, in efficitur tellus. Suspendisse eget odio ultricies, luctus nisi vel, molestie erat. Donec eleifend porta libero vel consequat. Nunc gravida urna quis pretium pharetra. Fusce lobortis libero ut molestie blandit. Nulla blandit, dolor egestas pretium efficitur, sapien tellus vulputate mauris, nec hendrerit nisl urna eget velit. Vivamus ut turpis auctor, facilisis elit in, porttitor ante. Nulla hendrerit nibh et orci scelerisque, scelerisque ultricies nulla facilisis. Nam nec nibh rutrum, gravida orci vel, tempus purus. Vivamus ut diam ipsum. Cras ullamcorper libero in congue euismod. Suspendisse sagittis arcu id erat viverra malesuada.
</p>
<p>
Morbi dictum ligula non velit consectetur sollicitudin. Integer condimentum pulvinar diam, vel congue ipsum ultrices eu. Duis sed aliquam ex. Phasellus nec lacinia nunc. Maecenas est magna, finibus non hendrerit vitae, pretium eget leo. Vivamus sed nibh sed mi vulputate condimentum. Praesent interdum efficitur suscipit. Mauris a fermentum libero. Sed nec dolor sed massa scelerisque consequat at eget eros. Donec interdum leo et porttitor consequat. Nunc ut facilisis felis. Vestibulum libero orci, mattis vitae cursus sit amet, sagittis id quam. Integer quis sem dictum lorem ultrices mollis. Donec et mi justo. In feugiat euismod lectus. Donec consequat leo in ex pellentesque, nec pretium leo posuere.
</p>
<p>
Aenean non enim a tortor interdum placerat. Vestibulum accumsan ornare accumsan. Fusce at lacinia neque. Vestibulum quis facilisis augue. Cras libero justo, semper nec dictum id, dapibus eu ligula. Aliquam erat volutpat. Etiam vulputate malesuada sodales. Morbi laoreet sapien vel ex ultrices, a faucibus massa aliquet. Quisque suscipit libero metus, sed sollicitudin mi commodo in. Nulla facilisi. Maecenas at ante et neque consequat finibus. Sed elementum elit odio, vel ornare eros rhoncus eget. In feugiat eros id dictum bibendum. Proin ligula odio, imperdiet a mi in, mollis venenatis quam. Duis aliquam, massa ac finibus sagittis, purus arcu maximus dui, ut gravida mi mauris vel lorem. Nulla non tellus elementum, ultricies metus auctor, hendrerit sem.
</p>
<p>
Vivamus sapien urna, ultrices in leo quis, pulvinar ultrices sapien. Etiam felis nisi, ultricies id turpis eu, congue tristique turpis. In tempus tellus vel suscipit ultrices. Integer ornare egestas dolor in accumsan. Donec eu finibus magna. Duis euismod, lacus non euismod ullamcorper, nisl nibh faucibus ante, et mollis turpis ex quis risus. Cras vehicula malesuada lobortis. Mauris elementum purus nec pharetra dictum.
</p>
<p>
Duis luctus laoreet orci, et vehicula dolor. In consequat, felis nec interdum mattis, nisl ante porttitor odio, non malesuada lectus metus sed mauris. Mauris egestas dictum euismod. Nunc lobortis lacinia magna a consequat. Maecenas vitae mi suscipit, rutrum nunc tempus, eleifend nunc. Praesent sodales vel turpis nec hendrerit. Duis vel ipsum in ipsum maximus laoreet porta at massa.
</p>
<p>
Nullam laoreet vulputate ipsum eu rutrum. Quisque eget nunc nunc. Phasellus luctus quis nulla quis tincidunt. Donec hendrerit tempor magna, nec rhoncus tortor ornare a. Phasellus at volutpat nisl. Fusce pretium nulla sed diam placerat varius. Etiam et mauris ex.
</p>
	</div>
</div>
@endsection
