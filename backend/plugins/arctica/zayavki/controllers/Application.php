<?php namespace Arctica\Zayavki\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Application extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController'    ];
    
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Arctica.Zayavki', 'main-menu-item');
    }
}
