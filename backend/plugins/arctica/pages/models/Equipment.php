<?php namespace Arctica\Pages\Models;

use Arctica\Services\Models\Service;
use Model;
use October\Rain\Database\Attach\File;

/**
 * Model
 */
class Equipment extends Model
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
    public $table = 'arctica_pages_equipment';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $attachMany = [
        'images' => 'System\Models\File',
    ];

    /**
     * @return Service
     */
    public function getRelatedService(): Service
    {
        return Service::where('page_slug', 'equipment')->get()->first();
    }

    public function getTitle(): string
    {
        return $this->getRelatedService()->name;
    }

    /**
     * @return array
     */
    public function getView(): array
    {
        return array_merge(
            $this->getRelatedService()->getView(),
            [
                'estimate' => $this->estimate,
                'images' => $this->images->map(
                    function (File $file): string {
                        return $file->getPath();
                    }
                ),
            ]
        );
    }
}
