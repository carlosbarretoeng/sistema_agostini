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

    public function scopeInCompany($query, $user)
    {
        if(!$user->hasRole('super-admin')){
            $departments = array_map(function($entry){ return $entry['id']; }, Department::inCompany($user)->get('id')->toArray());
            return $query->whereIn('department_id', $departments);
        }
        return $query;
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
