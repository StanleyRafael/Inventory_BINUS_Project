<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NormalUser;

class Log extends Model
{
    public function user()
    {
        return $this->belongsTo(NormalUser::class, 'user_id');
    }

    protected $table = 'logs';
    use HasFactory;
}
