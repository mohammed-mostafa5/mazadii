<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{

    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'product_translations';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fillable fields.
     * 
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;
}
