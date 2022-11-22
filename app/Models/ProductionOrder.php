<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductionOrder extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $with = ['company'];

    public function scopeInCompany($query, $user)
    {
        if(!$user->hasRole('super-admin')){
            $userCompanyId = $user->company_id;
            return $query->where('production_orders.company_id', $userCompanyId);
        }
        return $query;
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
