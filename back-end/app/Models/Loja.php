<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    use HasFactory;

    protected $table = 'lojas';

    protected $primaryKey = 'id_lojas';

    protected $fillable = [
        'nome',
        'cnpj'
    ];

    public function setLoja($info)
    {
        return $this->create($info);
    }
}
