<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $fillable = ['razao_social', 'cnpj','endereco','telefone','numero','cep' ];

    public function servicos()
    {
        return $this->hasMany (Servico::class);
    }
    public function ordemServicos()
    {
        return $this->hasMany (OrdemServico::class);
    }

}
