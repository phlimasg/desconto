<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class candidatos_irmao extends Model
{
    public function totvs()
    {
        return $this->hasOne(totvs::class,'RA','mat_insc_ci');
    }
}
