<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class candidato extends Model
{
    public function irmaos()
    {
        return $this->hasMany(candidatos_irmao::class, 'candidato_id_cand','id_cand');
    }
    public function compfam()
    {
        return $this->hasMany(composicaoFamiliar::class, 'candidato_id_cand','id_cand');
    }
    public function gpofamdesp()
    {
        return $this->hasMany(grupoFamiliarNew::class, 'candidato_id','id_cand');
    }
    public function respfin()
    {
        return $this->hasMany(grupoFamiliarNew::class, 'candidato_id_cand','id_cand');
    }
    public function desconto()
    {
        return $this->hasMany(descontoAutorizado::class, 'candidato_id_cand','id_cand');
    }
    
}
