<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['nama_category', 'photo_category'];
    protected $primaryKey = 'id_category';
}
