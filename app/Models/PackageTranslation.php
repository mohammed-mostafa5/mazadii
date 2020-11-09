<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model
{


    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'package_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name', 'duration'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
