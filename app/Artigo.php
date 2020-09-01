<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    protected $fillable = [
        'id_usuario', 'id_carro', 'nome_veiculo', 'img', 'link', 'ano', 'combustivel', 'quilometragem', 'cambio', 'portas', 'cor', 'preco',
    ];
}
