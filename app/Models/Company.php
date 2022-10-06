<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public function scopeInCompany($query, $user)
    {
        if(!$user->hasRole('super-admin')){
            $userCompanyId = $user->company_id;
            return $query->where('id', $userCompanyId);
        }
        return $query;
    }

    function departments() {
        return $this->hasMany(Department::class);
    }

    function products() {
        return $this->hasMany(Product::class);
    }
}
