<?php namespace Arctica\Contacts\Models;

use Model;

/**
 * Model
 */
class Contact extends Model
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
    public $table = 'arctica_contacts_contacts';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasOne = [
        'type' => [ContactsType::class, 'key' => 'id', 'otherKey' => 'type_id'],
    ];

    public function getTypeIdOptions()
    {
        return ContactsType::lists('name', 'id');
    }

    public function getType(): ContactsType
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getView(): array
    {
        return [
            'type' => $this->getType()->slug,
            'value' => $this->value
        ];
    }
}
