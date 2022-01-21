<?php namespace Arctica\RestApi;

use Backend;
use Cms\Classes\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use October\Rain\Exception\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use System\Classes\PluginBase;
use System\Classes\MediaLibrary;
use Illuminate\Support\Facades\Event;

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
            if ($exception instanceof NotFoundHttpException) {
                $code = 404;

                return JsonDataResponseTrait::json([], 404);
            }

            NotificationAlertHelper::alert($exception->getMessage());
            if (strpos(Request::decodedPath(), '/api') !== false || strpos(Request::decodedPath(), 'api/') !== false) {
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        });

        Event::listen('media.file.upload', function($widget, $filePath, $uploadedFile) {
            $originalName = $uploadedFile->getClientOriginalName();
            $cyr = [
                'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
                'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
                'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
                'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
            ];
            $lat = [
                'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
                'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
                'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
                'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
            ];
            $cyr2lat = str_replace($cyr, $lat, $originalName);
            $sanitizedFileName = str_replace(' ', '-', $cyr2lat);
            $filePathChunks = explode(DIRECTORY_SEPARATOR, $filePath);
            $filePathChunks[ (count($filePathChunks) - 1) ] = $sanitizedFileName;
            $newPath = implode(DIRECTORY_SEPARATOR, $filePathChunks);
            $isRename = true;
            MediaLibrary::instance()->moveFile($filePath, $newPath, $isRename);
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
