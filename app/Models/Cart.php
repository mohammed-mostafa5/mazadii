<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Support\Str;

/**
 * Class Cart
 * @package App\Models
 * @version June 8, 2020, 8:05 am UTC
 *
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $quantity
 */
class Cart extends Model
{

    public $table = 'carts';


    protected $dates = ['deleted_at'];

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
        'product_id' => 'integer',
        'quantity' => 'integer'
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

    protected $appends = ['total', 'price', 'photo', 'name'];


    public function getTotalAttribute()
    {
        return $this->attributes['total'] = $this->quantity * $this->product->price;
    }

    public function getPriceAttribute()
    {
        return $this->attributes['price'] = $this->product->price;
    }
    public function getPhotoAttribute()
    {
        return $this->attributes['photo'] = $this->product->photo;
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'] = Str::limit($this->product->name ?? '',50);
    }

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
