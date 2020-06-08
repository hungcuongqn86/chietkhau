<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    const STATUS_FALSE = 0;
    const STATUS_TRUE = 1;
    public static $status = [
        self::STATUS_FALSE => 'No',
        self::STATUS_TRUE => 'Yes'
    ];

    //Roles
    const ROLE_ADMIN = 'ADM';
    const ROLE_USER = 'USR';

    //Permission
    const PERMISSION_LIST_USER = 'LIST_USER';
    const PERMISSION_CREATE_USER = 'CREATE_USER';
    const PERMISSION_VIEW_USER = 'VIEW_USER';
    const PERMISSION_EDIT_USER = 'EDIT_USER';
    const PERMISSION_DELETE_USER = 'DELETE_USER';

    public $skip = false;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($data) {
            $data->created_at = date('Y-m-d H:i:s');
            $data->updated_at = date('Y-m-d H:i:s');
        });

        static::updating(function ($data) {
            $data->updated_at = date('Y-m-d H:i:s');
        });
    }
}
