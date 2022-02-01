<?php

namespace Arctica\Restapi\Controllers;

use Arctica\Pages\Models\Equipment;
use Arctica\Pages\Models\Main;
use Arctica\RestApi\JsonDataResponseTrait;
use Arctica\Services\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Arctica\Projects\Models\Project;
use October\Rain\Database\Builder;
use October\Rain\Database\Collection;

class Pages extends Controller
{

    /**
     * @return JsonResponse
     */
    public function mainPage(): JsonResponse
    {
        /**
         * @var Collection $favoriteProjects
         * @var Collection $services
         * @var Main $page
         */
        $favoriteProjects = Project::where('is_favorite', true)->where('is_active', true)->get();
        $services = Service::select()->get();
        $page = Main::where('id', 1)->get()->first();

        return JsonDataResponseTrait::json(
            array_merge(
                $page->getView(),
                [
                    'selected_projects' => $favoriteProjects->map(
                        function (Project $project): array {
                            return $project->getPreview();
                        }
                    )->toArray(),
                    'services' => $services->map(
                        function (Service $service): array {
                            return $service->getView();
                        }
                    )->toArray(),
                ]
            ),
            200,
            $page->getTitle()
        );
    }

    /**
     * @return JsonResponse
     */
    public function equipmentPage(): JsonResponse
    {
        /**
         * @var Equipment $page
         */
        $page = Equipment::where('id', 1)->get()->first();

        return JsonDataResponseTrait::json($page->getView(), 200, $page->getTitle());
    }

    /**
     * @return JsonResponse
     */
    public function monitoringPage(): JsonResponse
    {
        /**
         * @var Service $service
         */
        $service = Service::where('page_slug', 'monitoring')->get()->first();

        return JsonDataResponseTrait::json($service->getView(), 200, $service->name);
    }
}