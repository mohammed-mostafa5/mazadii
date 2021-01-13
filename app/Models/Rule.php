<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Rule
 * @package App\Models
 * @version January 13, 2021, 2:10 pm EET
 *
 * @property string $title
 * @property string $description
 */
class Rule extends Model
{
    use SoftDeletes, Translatable;

    public $table = 'rules';


    protected $dates = ['deleted_at'];

    public $fillable = ['id'];

    public $translatedAttributes =  ['title', 'description'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];
}
