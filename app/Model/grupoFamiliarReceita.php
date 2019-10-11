<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class grupoFamiliarReceita extends Model
{
    public function documentos()
    {
        return $this->hasMany(grupoFamiliarReceitasDocumentos::class, 'gpo_receitas_id','id');
    }
}
