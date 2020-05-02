<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $tabe = 'products';
    protected $fillable =[
    	'nama_product', 'category_id', 'amount', 'price', 'stock', 'photo_product'
    ];
    protected $primaryKey = 'id_product';

    public function categories()
    {
    	return $this->belongsTo('App\Category', 'category_id', 'id_category');
    }
}
