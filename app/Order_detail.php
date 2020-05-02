<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $table = 'order_details';
    protected $fillable = [
    	'order_id', 'product_id','quantity','total_price'
    ];
    protected $primaryKey = 'id_order_detail';

    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id', 'id_product');
    }
}
