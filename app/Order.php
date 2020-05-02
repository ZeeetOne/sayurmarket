<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
    	'user_id', 'order_number','status','city','address','description','total_quantity','total_price'
    ];
    protected $primaryKey = 'id_order';

    public function users()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id_user');
    }
}
