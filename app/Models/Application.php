<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'url',
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

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'application_users',
            'application_id',
            'user_id'
        )->withPivot('role_id');
    }
}
