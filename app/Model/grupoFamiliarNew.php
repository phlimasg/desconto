<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class grupoFamiliarNew extends Model
{
    public function documentos()
    {
        return $this->hasMany(grupoFamiliarNewDocumentos::class, 'grupo_familiar_id','id');
    }
}
