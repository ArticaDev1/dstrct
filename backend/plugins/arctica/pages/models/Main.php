<?php namespace Arctica\Pages\Models;

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

    public $attachMany = [
        'images' => 'System\Models\File',
    ];

    /**
     * @return array
     */
    public function getView(): array
    {
        return [
            'about' => $this->about,
            'images' => $this->images->map(
                function (File $file): array {
                    return [
                        'description' => $file->description,
                        'path' => $file->getPath(),
                    ];
                }
            )->toArray(),
        ];
    }
}
