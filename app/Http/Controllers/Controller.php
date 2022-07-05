<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Seblhaire\MenuAndTabUtils\MenuUtils;

class Controller extends BaseController
{
    public $mainmenu;
    public $rightmenu;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
      $this->mainmenu = MenuUtils::init('main-menu', [ //see MenuUtilsController for detailed comments
        'ulclass' => 'navbar-nav me-auto mb-2 mb-lg-0',
        'menu' => [
          'home-topmenu' => [
            'icon' => '<i class="fas fa-home fa-lg"></i>',
            'title' => 'Home',
            'target' => route('home'),
          ],
          'cv-topmenu' => [
              'title' => 'CV / Resumé',
              'target' => route('cv'),
          ],
          'publis-topmenu' => [
              'title' => 'Publications',
              'target' => route('publis'),
          ],
          'packages-topmenu' => [
            'title' => 'Packages',
            'dropdown' => [
              'paginator-topmenu' => [
                  'title' => 'Paginator',
                  'target' => route('paginator'),
              ],
              'daterangepicker-topmenu' => [
                  'title' => 'Daterangepicker Helper',
                  'target' => route('daterangepicker'),
              ],
              'tablebuilder-topmenu' => [
                  'title' => 'Table builder',
                  'target' => route('tablebuilder'),
              ],
              'uploader-topmenu' => [
                  'title' => 'Uploader',
                  'target' => route('uploader'),
              ],
              'autocompleter-topmenu' => [
                  'title' => 'Autocompleter',
                  'target' => route('autocompleter'),
              ],
              'tagsinput-topmenu' => [
                  'title' => 'Tags input',
                  'target' => route('tagsinput'),
              ],
              'formsbootstrap-topmenu' => [
                  'title' => 'FormsBootstrap',
                  'target' => route('formsbootstrap'),
              ],
              'menuutils-topmenu' => [
                  'title' => 'Menu and Tab Utils',
                  'target' => route('menuutils'),
              ],
            ]
          ]
        ]
      ]);
      $this->rightmenu = MenuUtils::init('main-right-menu', [ //see MenuUtilsController for detailed comments
        'ulclass' => 'navbar-nav flex-row flex-wrap ms-md-auto',
        'menu' => [
          'corpuslink' => [
            'title' => 'Corpus',
            'target' => 'https://corpus.lhaire.org/',
            'attributes' => [
              'target' => '_blank',
              'rel' => "noopener noreferrer"
            ]
          ],
        ],
      ]);
    }
}
