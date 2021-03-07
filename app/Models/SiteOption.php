<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class SiteOption
 * @package App\Models
 * @version January 11, 2021, 12:22 pm EET
 *
 * @property integer $product_duration
 * @property integer $deposit_percentage
 */
class SiteOption extends Model
{

    public $table = 'site_options';

    public $fillable = [
        'product_duration',
        'deposit_percentage',
        'subscription_fees'
    ];

    public static $rules = [
        'product_duration' => 'required',
        'deposit_percentage' => 'required',
        'subscription_fees' => 'required',
    ];
}
