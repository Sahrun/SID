<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';
    protected $primaryKey = 'user_role_id';
    protected $timestam = true;
    protected $fillable = [
        'user_role_name',
        'created_at',
        'updated_at'
    ];
}
