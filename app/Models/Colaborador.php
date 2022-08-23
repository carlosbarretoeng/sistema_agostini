<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $table = "colaboradores";

    public function setor()
    {
        return $this->hasOne(Setor::class, 'setor_id');
    }
}
