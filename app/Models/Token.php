<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = [
        'email',
    ];

    protected $hidden = ['password'];

    protected $dates = [
        'updated_at',
        'created_at',
        'expires_at'
    ];
}
