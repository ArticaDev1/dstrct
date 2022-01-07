<?php namespace Arctica\Projects\Models;

use Model;
use Arctica\Projects\Models\Attribute;
use Arctica\Projects\Models\Project;

/**
 * Model
 */
class ProjectAttributes extends Model
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
    public $table = 'arctica_projects_projects_attributes';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'value' => 'required'
    ];

    public $hasOne = [
        'project' => [Project::class, 'key' => 'id', 'otherKey' => 'project_id'],
        'attribute' => [Attribute::class, 'key' => 'id', 'otherKey' => 'attribute_id'],
    ];

    public $belongsTo = [
        'project' => [
            Project::class,
        ],
    ];

    public function getProjectIdOptions()
    {
        return Project::lists('name', 'id');
    }

    public function getAttributeIdOptions()
    {
        return Attribute::lists('name', 'id');
    }

    public function getAttributeModel(): Attribute
    {
        return $this->attribute;
    }

    public function getShortView(): array
    {
        return [
            'name' => $this->attribute->name,
            'value' => $this->value,
        ];
    }
}
