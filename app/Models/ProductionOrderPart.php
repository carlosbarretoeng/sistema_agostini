<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductionOrderPart extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $with = ['product_recipe'];

    public function scopeInCompany($query, $user)
    {
//        if(!$user->hasRole('super-admin')){
//            $userCompanyId = $user->company_id;
//            return $query->where('company_id', $userCompanyId);
//        }
        return $query;
    }

    public function product_recipe(){
        return $this->belongsTo(ProductRecipe::class);
    }
}
