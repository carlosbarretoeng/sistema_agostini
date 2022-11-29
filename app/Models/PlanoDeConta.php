<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanoDeConta extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['company'];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function scopeInCompany($query, $user)
    {
        if(!$user->hasRole('super-admin')){
            $userCompanyId = $user->company_id;
            return $query->where('company_id', $userCompanyId);
        }
        return $query;
    }
}
