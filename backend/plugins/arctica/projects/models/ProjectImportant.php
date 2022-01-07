<?php namespace Arctica\Projects\Models;

use Model;

/**
 * Model
 */
class ProjectImportant extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    public $hasOne = [
        'project' => [Project::class, 'key' => 'id', 'otherKey' => 'project_id'],
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'arctica_projects_projects_important';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'value' => 'required'
    ];

    public function getProjectIdOptions()
    {
        return Project::lists('name', 'id');
    }

    public function getView(): string
    {
        return $this->value;
    }
}
