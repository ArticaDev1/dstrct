<?php

namespace Arctica\Restapi\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Arctica\Projects\Models\Project as ProjectModel;
use Illuminate\Support\Collection;
use Arctica\RestApi\JsonDataResponseTrait;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Project extends Controller
{
    /**
     * @param string $projectSlug
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public static function getProject(string $projectSlug): JsonResponse
    {
        /**
         * @var Collection $collection
         * @var Collection $seeAlso
         */
        $collection = ProjectModel::where('slug', $projectSlug)->get();

        if ($collection->isEmpty()) {
            throw new NotFoundHttpException(sprintf('Проект %s не найден', $projectSlug));
        }

        $project = $collection->first();

        if (!$project->is_active) {
            throw new \Exception(sprintf('Проект %s не найден', $projectSlug));
        }

        $seeAlso = ProjectModel::whereNotIn('slug', [$projectSlug])->get();

        return JsonDataResponseTrait::json([
            'project' => $project->getView(),
            'see_also' => $seeAlso->slice(0, 4)->map(
                function (ProjectModel $project): array {
                    return $project->getPreview();
                }
            )
        ]);
    }

    /**
     * Возвращает все активные проекты как превью
     *
     * @return JsonResponse
     */
    public static function getAllActive(): JsonResponse
    {
        /**
         * @var Collection $collection
         */
        $collection = ProjectModel::where('is_active', true)->get();

        return JsonDataResponseTrait::json([
            'projects' => $collection->map(
                function (ProjectModel $project): array {return $project->getPreview();}
            )->toArray()
        ]);

    }
}
