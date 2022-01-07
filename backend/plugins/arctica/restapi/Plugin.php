<?php namespace Arctica\RestApi;

use Backend;
use Illuminate\Support\Facades\App;
use October\Rain\Exception\ValidationException;
use System\Classes\PluginBase;

/**
 * RestApi Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'RestApi',
            'description' => 'No description provided yet...',
            'author'      => 'arctica',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        App::error(function (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Arctica\RestApi\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'arctica.restapi.some_permission' => [
                'tab' => 'RestApi',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'restapi' => [
                'label'       => 'RestApi',
                'url'         => Backend::url('arctica/restapi/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['arctica.restapi.*'],
                'order'       => 500,
            ],
        ];
    }
}
