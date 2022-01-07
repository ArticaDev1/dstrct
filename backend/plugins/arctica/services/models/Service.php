<?php namespace Arctica\Services\Models;

use Model;

/**
 * Model
 */
class Service extends Model
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
    public $table = 'arctica_services_service';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @return array
     */
    public function getView(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'about' => $this->about,
            'page_slug' => $this->page_slug,
            'price' => $this->price,
            'price_description' => $this->price_description,
            'signature' => $this->signature,
        ];
    }
}
