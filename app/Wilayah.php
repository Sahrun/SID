<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
       //
       protected $table = 'wilayah';
       protected $primaryKey ='wilayah_id';
       protected $timestam = true;
       Protected $fillable = [
        "wilayah_part",
        "wilayah_dusun",
        "wilayah_rw", 	
        "wilayah_rt", 	
        "wilayah_nama", 	
        "created_at", 	
        "updated_at", 	
        "penduduk_id", 
     ];
     public $part = array(
      "dusun" => "1",
      "rw" => "2",
      "rt" => "3"
  );
       
}
