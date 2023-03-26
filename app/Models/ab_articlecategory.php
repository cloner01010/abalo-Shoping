<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_articlecategory extends Model
{
    use HasFactory;
    protected $table='ab_articlecategory';
    protected $primaryKey = 'id';
  // protected $attributes=
  //     [
  //         'id',
  //         'ab_name',
  //         'ab_description',
  //         'ab_parent',
  //         'created_at',
  //         'deleted_at'
  //     ];
}//
