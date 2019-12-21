<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    protected $table = 'identitas_desa';
    protected $primaryKey ='identitas_id';
    protected $timestam = true;
    Protected $fillable = [
                "identitas_key",
                "identitas_title",
                "identitas_value",
                "created_at",
                "updated_at",
              ];
}
