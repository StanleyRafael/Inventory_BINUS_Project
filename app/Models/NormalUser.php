<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NormalUser extends Authenticatable
{
    protected $fillable = [
        'username',
    ];

    protected $table = 'normal_user';
    use HasFactory;
}
