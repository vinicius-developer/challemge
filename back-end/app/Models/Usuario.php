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

    public function setUsuario($info)
    {
        return $this->create($info);
    }

    public function getUsuarioComEmail($email)
    {
        return $this->where('email', $email);
    }

    public function getUsuarioComId($id)
    {
        return $this
            ->select(
                'id_usuarios',
                'id_lojas',
                'nome',
                'email',
            )
            ->where('id_usuarios', $id);
    }

    public function getUsuarios()
    {
        return $this->select(
            'usuarios.id_usuarios',
            'usuarios.nome as nome_usuario',
            'email',
            'lj.id_lojas',
            'lj.nome as nome_loja',
        )
            ->leftJoin('lojas as lj', 'lj.id_lojas', '=', 'usuarios.id_lojas');   
    }

    public function getUsuariosLojaEspecifica($idLoja)
    {
        return $this->select(
            'usuarios.id_usuarios',
            'usuarios.nome as nome_usuario',
            'email',
            'lj.id_lojas',
            'lj.nome as nome_loja',
            
        )
            ->join('lojas as lj', 'lj.id_lojas', '=', 'usuarios.id_lojas')
            ->where('usuarios.id_lojas', $idLoja);
    }

    public function addLojaUsuario($idLojas, $idUsuarios) 
    {
        return $this->where('id_usuarios', $idUsuarios)->update([
            'id_lojas' => $idLojas
        ]);
    }
}
