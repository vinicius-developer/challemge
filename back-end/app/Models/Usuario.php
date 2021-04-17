<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuarios';

    protected $fillable = [
        "id_lojas",
        "nome",
        "email",
        "senha"
    ];

    protected $hidden = [
        "senha"
    ];

    public function setUsuario($info)
    {
        return $this->create($info);
    }
}
