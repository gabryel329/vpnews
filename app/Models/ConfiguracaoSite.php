<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracaoSite extends Model
{
    use HasFactory;

    protected $table = 'configuracoes_site';

    protected $fillable = [
        'icon',
        'nome',
        'logo',
        'sobre_roda_pe',
        'textonossotime',
        'sobre1',
        'sobre1cor',
        'sobre2',
        'sobre2cor',
        'telefone',
        'email',
        'localizacao',
        'cor_background',
        'corhouve',
    ];
}
