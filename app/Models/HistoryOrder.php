<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class HistoryOrder
 * @package App\Models
 * @version May 20, 2020, 10:45 am UTC
 *
 * @property integer $company_id
 * @property integer $pharmacy_id
 * @property integer $status
 */
class HistoryOrder extends Model
{
    use SoftDeletes;

    public $table = 'history_orders';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'company_id',
        'distributor_id',
        'pharmacy_id',
        'status',
        'alltotal',
        'delivered_at',
        'code',
        'value',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'company_id' => 'integer',
        'pharmacy_id' => 'integer',
        'status' => 'integer',
        'order_status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    public function pharmacy()
    {
        return $this->belongsTo('App\Models\Pharmacy', 'pharmacy_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'history_order_products', 'history_order_id', 'product_id')->withPivot('quantity','price','total');
    }
    

}
