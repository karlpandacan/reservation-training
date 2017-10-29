<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    protected $fillable = [
        'application_id',
        'code',
        'name',
        'description',
        'updated_by',
        'updated_at',
        'created_by',
        'created_at',
        'deleted_at',
    ];

    protected $hidden = ['password'];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];
}
