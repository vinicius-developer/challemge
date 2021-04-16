<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefoneUsuario extends Model
{
    use HasFactory;

    protected $table = 'telefone_usuarios';

    protected $primaryKey = 'id_telefone_usuarios';

    protected $fillable = [
        "id_usuaros",
        "telefone"
    ];
}
