<?php namespace Arctica\Applications\Controllers;

use Arctica\Applications\Models\Application;
use Backend\Classes\Controller;
use BackendMenu;

class Applications extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\ReorderController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
    }

    public static function create(): string
    {
        $input = \Input::only([
            'name',
            'message',
            'phone',
            'url'
        ]);

        $model = new Application();

        $model->name = $input['name'];
        $model->text = $input['message'];
        $model->phone = $input['phone'];
        $model->from = $input['url'];

        $model->save();

        $data = [
            'name' => $model->name,
            'text' => $model->text,
            'phone' => $model->phone,
            'url' => $model->from,
        ];

        foreach (['Daruf@mail.ru', 'Office@dexsa.ru'] as $email) {
            \Mail::send('dexsa.contact::contact', $data, function ($message) use ($email) {
                $message->to($email);
            });
        }


        return json_encode('ok');
    }
}
