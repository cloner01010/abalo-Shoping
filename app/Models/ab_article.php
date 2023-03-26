<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_article extends Model
{
    use HasFactory;
    protected $table='ab_article';
    protected $primaryKey = 'id';
   // protected $fillable=[
   //     'id',
   //     'ab_name',
   //     'ab_description',
   //     'ab_price',
   //     'ab_creator_id',
   //     'ab_createdate'
   // ];
   // protected $attributes=
   //     [
   //         'id',
   //         'ab_name',
   //         'ab_description',
   //         'ab_price',
   //         'ab_creator_id',
   //         'ab_createdate',
   //         'created_at',
   //         'deleted_at'
   //     ];
}
