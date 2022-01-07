<?php namespace Arctica\Contacts\Models;

use Model;

/**
 * Model
 */
class ContactsType extends Model
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
    public $table = 'arctica_contacts_contacts_type';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
