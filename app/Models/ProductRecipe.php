<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductRecipe extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $with = ['product', 'part'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function part(){
        return $this->belongsTo(Part::class);
    }
}
