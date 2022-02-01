<?php namespace Arctica\Pages\Models;

use Arctica\Projects\Models\Project;
use October\Rain\Database\Attach\File;
use October\Rain\Database\Model;
use October\Rain\Exception\ValidationException;

/**
 * Model
 */
class Main extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'arctica_pages_main';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $jsonable = ['images'];

    public $attachMany = [
        'main_page_project_image' => 'System\Models\File',
    ];

     /**
      * @return mixed
      */
    public function getProjectIdOptions()
    {
        return Project::lists('name', 'slug');
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getView(): array
    {
        return [
            'about' => $this->about,
            'projects' => $this->getProjects(),
        ];
    }

    public function getProjects(): array
    {
        $activeImages = [];

        foreach ($this->images as $image) {
            if ($image['is_active'] === '1') {
                $activeImages[] = $image;
            }
        }

        foreach (array_slice($activeImages, 0, 7) as $image) {
            $project = Project::where('slug', $image['project_id'])->get()->first();

            $projectImage = empty($image['main_page_project_image']) ?
                $project->getFirstImage()->getPath() :
                sprintf('%s%s', 'https://dstrct-bureau.com/backend/storage/app/media', $image['main_page_project_image']);

            $result[] = [
                'slug' => $image['project_id'],
                'image' => $projectImage,
                'description' => $image['project_photo_description']
            ];
        }

        return $result ?? [];
    }
}
