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
        "id_usuarios",
        "telefone"
    ];

    public function setTelefone($infos)
    {
        $arr = collect([]);

        foreach($infos as $info) {
            $arr->push($this->create($info));
        }

        return $arr;
    }

    public function getAllTelefonesUsuariosEspecifico($usuarios)
    {

        foreach($usuarios as $usuario) {
            
            $telefones = $this->where('id_usuarios', $usuario->id_usuarios);

            $usuario->telefone = $telefones->get()->pluck('telefone');

        }

        return $usuarios;

    }

    public function getAllTelefonesUsuarioEspecifico($user)
    {
        return $this->where('id_usuarios', $user->id_usuarios);
    }

}
