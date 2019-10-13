<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class composicaoFamiliar extends Model
{
    public function documentos()
    {
        return $this->hasMany(documentos::class, 'composicaofamiliar_id_comp','id_comp');
    }
}
