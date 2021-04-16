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
        "id_loja",
        "nome",
        "email",
        "senha"
    ];

    protected $hidden = [
        "email",
        "senha"
    ];
}
