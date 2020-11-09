<?php

namespace App\Models;

use Eloquent as Model;
use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class category
 * @package App\Models
 * @version May 11, 2020, 11:33 am UTC
 *
 * @property string name
 * @property string photo
 * @property integer status
 */
class Category extends Model
{
    use SoftDeletes, Translatable, ImageUploaderTrait;

    public $table = 'categories';


    protected $dates = ['deleted_at'];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  ['name'];

    public $fillable = [
        'parent_id',
        'photo',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'photo' => 'string',
        'parent_id' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string|min:3|max:191';
        }

        $rules['status'] = 'required|in:0,1';
        $rules['photo'] = 'required|image|mimes:jpeg,jpg,png';

        return $rules;
    }

    public function setPhotoAttribute($file)
    {
        try {

            if ($file) {
                if (is_array($file)) {
                    foreach ($file as $f) {
                        $fileName = $this->createFileName($f);

                        $this->originalImage($f, $fileName);

                        $this->thumbImage($f, $fileName, 182, 182);

                        $this->attributes['photo'] = $fileName;
                    }
                } else {
                    $fileName = $this->createFileName($file);

                    $this->originalImage($file, $fileName);

                    $this->thumbImage($file, $fileName, 182, 182);

                    $this->attributes['photo'] = $fileName;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    protected $appends = ['photo_original_path', 'photo_thumbnail_path'];

    public function getPhotoOriginalPathAttribute()
    {
        return asset('uploads/images/original/' . $this->photo);
    }
    public function getPhotoThumbnailPathAttribute()
    {
        return asset('uploads/images/thumbnail/' . $this->photo);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // IN Order TO ///////////////////////////
    public function scopeInOrderTOProdcut($query)
    {
        return $query->where('in_order_to', 1);
    }

    public function scopeInOrderTOMagazine($query)
    {
        return $query->where('in_order_to', 2);
    }

    public function scopeInOrderTOService($query)
    {
        return $query->where('in_order_to', 3);
    }

    public function scopeInOrderTOBlog($query)
    {
        return $query->where('in_order_to', 4);
    }
    // IN Order TO ///////////////////////////

    public function scopeParent($query)
    {
        return $query->where('parent_id', null);
    }

    public function scopeChild($query)
    {
        return $query->where('parent_id', '!=', null);
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }
    public function parentCategory()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id', 'id');
    }

    /**
     * Get all of the product for the Parent.
     */
    public function productsCategory()
    {
        // return $this->hasManyThrough('App\Models\Category', 'App\Models\Product');

        return $this->hasManyThrough(
            'App\Models\Product',
            'App\Models\Category',
            'parent_id', // Foreign key on category child table...
            'category_id', // Foreign key on Products table...
            'id', // Local key on category Parent table...
            'id' // Local key on category child table...
        );
    }
}
