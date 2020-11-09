<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
/**
 * Class Cart
 * @package App\Models
 * @version June 8, 2020, 8:05 am UTC
 *
 * @property integer $user_id
 */
class CartProducts extends Pivot
{

    public $table = 'cart_products';

    public $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'product_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required',
        'quantity' => 'required',
    ];

    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;

    
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
