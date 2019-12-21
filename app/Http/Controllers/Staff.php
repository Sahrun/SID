<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $primaryKey ='staff_id';
    protected $timestam = true;
    Protected $fillable = [
                "nama_staff",
                "staff_nik",
                "staff_nip",
                "staff_posisi",
                "created_at",
                "updated_at",
              ];
}
