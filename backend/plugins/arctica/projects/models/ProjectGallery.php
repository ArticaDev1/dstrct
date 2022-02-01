<?php namespace Arctica\Projects\Models;

use Model;
use October\Rain\Database\Collection;
use October\Rain\Exception\ValidationException;
use October\Rain\Support\Facades\Flash;

/**
 * Model
 */
class ProjectGallery extends Model
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
    public $table = 'arctica_projects_galleries';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $attachMany = [
        'images' => 'System\Models\File',
    ];

    public $hasOne = [
        'project' => [Project::class, 'key' => 'id', 'otherKey' => 'project_id'],
        'gallery_template' => [GalleryTemplate::class, 'key' => 'id', 'otherKey' => 'gallery_id'],
    ];

    /**
     * @return string
     */
    public function getApiName(): string
    {
        return $this->gallery_template->name;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function getProjectIdOptions()
    {
        $existedGalleries = self::All();
        $lastGallery = null;
        foreach ($existedGalleries as $gallery) {
            if (is_null($lastGallery) || $gallery->created_at > $lastGallery->created_at) {
                $lastGallery = $gallery;
            }
        }

        $projects = Project::lists('name', 'id');
        if (!is_null($lastGallery)) {
            $lastProjectId = $lastGallery->project_id;

            $result = [$lastProjectId => $projects[$lastProjectId]];

            foreach ($projects as $id => $projectName) {
                if (!array_key_exists($id, $result)) {
                    $result[$id] = $projectName;
                }
            }
        }

        return $result ?? $projects;
    }

    public function getGalleryIdOptions()
    {
        return GalleryTemplate::lists('view_name', 'id');
    }

    public function afterUpdate()
    {
        $this->checkCount();
        parent::afterSave();
    }

    public function isActive()
    {
        return $this->getImages()->count() > 0 && $this->is_active == true;
    }

    protected function beforeCreate()
    {
        parent::beforeCreate();

        $this->created_at = new \DateTimeImmutable();

        if (is_null($this->sort)) {
            $lastRecord = self::where('project_id', $this->project_id)->orderBy('sort', 'desc')->get()->first();

            if (is_null($lastRecord)) {
                $this->sort = 0;
            } else {
                $this->sort = $lastRecord->sort + 1;
            }
        }
    }

    public function afterCreate()
    {
        $this->checkCount();
        parent::afterCreate();
    }

    private function checkCount(): void
    {
        $count = $this->images->count();

        // if ($count === 0) {
        //     throw new ValidationException(
        //         ['images' => 'Фотографий не может меньше ' . 0]
        //     );
        // }

        if ($count > $this->gallery_template->count_of_images) {
            throw new ValidationException(
                ['images' => 'Фотографий не может больше ' . $this->gallery_template->count_of_images]
            );
        }
    }
}
