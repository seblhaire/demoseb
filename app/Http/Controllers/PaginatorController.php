<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Seblhaire\BootstrapPaginator\BootstrapPaginator;

class PaginatorController extends Controller
{

      /**
    * Demo page for BootstrapPaginator. Outputs a classical paginator (type classic), alphabetical (type alpha) or both paginators (type combi)
    * @param  string $paginatortype either classic|alpha|combi default classic
    * @param  string|integer $param1        route parameter: page number or initial letter : default null, equals 1 or 'all' depending on paginator type
    * @param  [type] $param2        second route parameter. default null, equals 1 for combi, not use in other cases
    * @return View                [description]
    */
    public function index($paginatortype = 'classic', $param1 = null, $param2 = null){
        $route = 'paginator'; //route to be used in paginators
        switch($paginatortype){
            case 'classic' :
                if (is_null($param1)) $param1 = 1; // default value
                $paginator2 = null; // only one paginator used
                $title = "Bootstrap Paginator classical";
                $title2 = 'Page ' . $param1;
                $options = [
                  'nbpages' => 11, //usually depends on data retrieved in database
                  'pageparam' => 'param1', // matches page parameter to actual route parameter. If your route uses config('bootstrappaginator.pageparam) ('page'), you dont need to set this value
                  'params' => [
                    'paginatortype' => 'classic' // additional parameter to be used to build route
                    ]
                  ];
                $paginator = BootstrapPaginator::init($param1, $route, $options); //param1 is our page number
                break;
            case 'alpha' :
                // sets default parameter
                $initial = is_null($param1) ?
                    config('bootstrappaginator.valueforall') : // this value is translation key paginator.all that you need to modify yourself
                      $param1;
                $paginator2 = null;
                $title = "Bootstrap Paginator classical";
                $title2 = 'Page ' . $param1;
                $optionalpha = [
                  'type' => 'alpha', // sets paginator type
                  'initialparam' => 'param1', // parameter used by paginator. If you use  config('bootstrappaginator.initialparam) ('initial'), no need to use parameter
                  'params' => ['paginatortype' => 'alpha'] // additional parameter to build route
                ];
                $paginator = BootstrapPaginator::init($initial, $route, $optionalpha);
                break;
            case 'combi' :
                // this case combines both paginators in same page. See comments above
                $initial = is_null($param1) ? config('bootstrappaginator.valueforall') : $param1;
                $page = is_null($param2) ? 1 : $param2;
                $optionalpha = ['type' => 'alpha', 'initialparam' => 'param1', 'params' => ['paginatortype' => 'combi']];
                $options = ['nbpages' => 4, 'pageparam' => 'param2', 'params' => ['paginatortype' => 'combi', 'param1' => $initial]];
                $paginator = BootstrapPaginator::init($page, $route, $options);
                $paginator2 = BootstrapPaginator::init($initial, $route, $optionalpha);
                $title = "Bootstrap Paginator combi";
                $title2 = 'Page ' . $param1 . ' ' . $param2;
        }
        // Simply send paginator(s) that you have inited before to your view
        return view('paginator', [
            'title' => $title,
            'title2' => $title2,
            'paginator' => $paginator,
            'paginator2' => $paginator2,
            'menu' => 'paginator'
        ]);
    }
}
