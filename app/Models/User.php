<?php
namespace App\Models;

use App\Models\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'updated_by',
        'updated_at',
        'created_by',
        'created_at',
    ];

    protected $hidden = [
        'password',
        'updated_by',
        'updated_at',
        'created_by',
        'created_at',
        'deleted_at',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    public function applications()
    {
        return $this->belongsToMany(
            Application::class,
            'application_users',
            'user_id',
            'application_id'
        )->withPivot('role_id');
    }

    public function current(){
        return $this->revisions()->where('srid', $this->srid);
    }
}
