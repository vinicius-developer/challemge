<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecoLoja extends Model
{
    use HasFactory;

    protected $table = 'endereco_lojas';

    protected $primaryKey = 'id_endereco_lojas';

    protected $fillable = [
        'id_lojas',
        'rua',
        'cep',
        'bairro',
        'cidade',
        'UF',
    ];
}
