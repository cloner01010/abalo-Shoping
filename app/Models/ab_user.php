<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_user extends Model
{
    use HasFactory;
    protected $table='ab_user';
    protected $primaryKey = 'id';
   // protected $attributes=
   //     [
   //         'id',
   //         'ab_name',
   //         'ab_passwort',
   //         'ab_mail',
   //         'created_at',
   //         'deleted_at'
   //     ];
}
