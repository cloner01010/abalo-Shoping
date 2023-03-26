<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_article_has_articlecategory extends Model
{
    use HasFactory;
    protected $table='ab_article_has_articlecategory';
    protected $primaryKey = 'id';
    protected $attributes=
        [
            'id',
            'ab_article_id',
            'ab_articlecategory_id',
            'created_at',
            'deleted_at'
        ];
}
