<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Department extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $with = ['company'];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function machineries() {
        return $this->hasMany(Machinery::class);
    }
}
