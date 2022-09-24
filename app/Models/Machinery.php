<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Machinery extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $with = ['department'];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
