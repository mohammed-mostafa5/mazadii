<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Package
 * @package App\Models
 * @version October 15, 2020, 12:54 pm UTC
 *
 * @property string $name
 * @property number $price
 * @property string $duration
 */
class Package extends Model
{
    use SoftDeletes, Translatable;

    public $table = 'packages';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'price',
        'duration'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'price' => 'float',
        'duration' => 'string'
    ];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'name',
    ];


    /**
     * Rules validation
     *
     * @return array vaildations rules
     */
    public static function rules()
    {
        $languages = array_keys(config('langs'));
        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string';
            $rules[$language . '.duration'] = 'required|string';
        }

        return $rules;
    }



    // Relations

    public function features()
    {
        return $this->belongsToMany('App\Models\Feature', 'package_feature', 'package_id', 'feature_id')->withPivot('value');
    }
}
