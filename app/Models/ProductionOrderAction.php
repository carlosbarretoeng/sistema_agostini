<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductionOrderAction extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public function scopeInCompany($query, $user)
    {
//        if(!$user->hasRole('super-admin')){
//            $userCompanyId = $user->company_id;
//            return $query->where('company_id', $userCompanyId);
//        }
        return $query;
    }

    protected $with = ['action', 'user'];

    public function action(){
        return $this->belongsTo(Action::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
