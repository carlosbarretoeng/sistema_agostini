<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudModel extends Model
{
    use HasFactory;

    public function scopeEmpresaDefinida($query, $id)
    {
        return $query->where('empresas_id', $id);
    }
}
