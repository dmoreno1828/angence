<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Salario;
class Usuario extends Model
{
    protected $table = 'cao_usuario';


    public function permisos()
    {
         return $this->belongsTo('permissao_sistema', '	co_usuario', 'co_usuario');
    }

    public function salario()
    {
         return $this->belongsTo(Salario::Class, 'co_usuario', 'co_usuario');
    }
}
