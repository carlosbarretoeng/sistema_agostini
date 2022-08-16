<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['cnpj','name','fantasia','logo','email','logradouro','numero','complemento','bairro','municipio','uf','cep','telefone'];
}
