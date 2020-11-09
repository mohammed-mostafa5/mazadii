<?php

namespace App\Models;

use Eloquent as Model;
use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version May 18, 2020, 11:27 am UTC
 *
 * @property string $name
 * @property string $description
 * @property string $photo
 */
class Product extends Model
{
    /**
     * Trait Used.
     */
    use SoftDeletes, Translatable, ImageUploaderTrait;

    /**
     * Table Name.
     *
     * @var array
     */
    public $table = 'products';

    /**
     * Dates attributes.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  ['name', 'description'];

    /**
     * Fillable attributes.
     *
     * @var array
     */
    public $fillable = [
        'category_id',
        'name',
        'description',
        'admin_id',
        'regular_price',
        'offer',
        'sale_price',
        'status',
        'sku',
        'views',
        'type',
        'color_id',
        'size_id',
        'style_id',
        'brand_id',
        'weight_id',
        'photo_1',
        'photo_2',
        'photo_3',



    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'photo' => 'string'
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
            $rules[$language . '.name'] = 'required|string|min:3';
            $rules[$language . '.description'] = 'required|string|min:3';
        }

        // $rules['photo'] = 'required|image|mimes:jpeg,jpg,png';
        $rules['regular_price'] = 'required';
        $rules['sale_price'] = '';
        $rules['category_id'] = 'required';
        $rules['offer'] = '';
        $rules['status'] = 'required';
        $rules['sku'] = 'required';
        $rules['views'] = '';
        $rules['color_id'] = '';
        $rules['size_id'] = '';
        $rules['style_id'] = '';
        $rules['brand_id'] = '';
        $rules['weight_id'] = '';
        $rules['photo_1'] = 'required|image|mimes:jpeg,jpg,png';
        $rules['photo_2'] = '';
        $rules['photo_3'] = '';

        return $rules;
    }


    /**
     * Set photo_1 and storge.
     */
    public function setPhoto1Attribute($file)
    {
        try {
            if ($file) {
                if (is_array($file)) {

                    foreach ($file as $f) {
                        $fileName = $this->createFileName($f);

                        $this->originalImage($f, $fileName);

                        $this->thumbImage($f, $fileName, 300, 300);

                        $this->attributes['photo_1'] = $fileName;
                    }
                } else {

                    $fileName = $this->createFileName($file);

                    $this->originalImage($file, $fileName);

                    $this->thumbImage($file, $fileName, 300, 300);

                    $this->attributes['photo_1'] = $fileName;
                }
            }
        } catch (\Throwable $th) {
            $this->attributes['photo_1'] = $file;
        }
    }

    /**
     * Set photo_2 and storge.
     */
    public function setPhoto2Attribute($file)
    {
        try {
            if ($file) {
                if (is_array($file)) {

                    foreach ($file as $f) {
                        $fileName = $this->createFileName($f);

                        $this->originalImage($f, $fileName);

                        $this->thumbImage($f, $fileName, 216, 216);

                        $this->attributes['photo_2'] = $fileName;
                    }
                } else {

                    $fileName = $this->createFileName($file);

                    $this->originalImage($file, $fileName);

                    $this->thumbImage($file, $fileName, 216, 216);

                    $this->attributes['photo_2'] = $fileName;
                }
            }
        } catch (\Throwable $th) {
            $this->attributes['photo_2'] = $file;
        }
    }

    /**
     * Set photo_3 and storge.
     */
    public function setPhoto3Attribute($file)
    {
        try {
            if ($file) {
                if (is_array($file)) {

                    foreach ($file as $f) {
                        $fileName = $this->createFileName($f);

                        $this->originalImage($f, $fileName);

                        $this->thumbImage($f, $fileName, 216, 216);

                        $this->attributes['photo_3'] = $fileName;
                    }
                } else {

                    $fileName = $this->createFileName($file);

                    $this->originalImage($file, $fileName);

                    $this->thumbImage($file, $fileName, 216, 216);

                    $this->attributes['photo_3'] = $fileName;
                }
            }
        } catch (\Throwable $th) {
            $this->attributes['photo_3'] = $file;
        }
    }

    #################################################################################
    ################################### Appends #####################################
    #################################################################################

    protected $appends = ['is_fav', 'is_in_cart', 'rate', 'price', 'photo1_path', 'photo2_path', 'photo3_path'];

    /**
     * append photo_1 with path.
     */
    public function getphoto1PathAttribute()
    {

        return $this->photo_1 ? asset('uploads/images/original/' . $this->photo_1) : null;
    }

    /**
     * append photo_2 with path.
     */
    public function getphoto2PathAttribute()
    {
        return $this->photo_2 ? asset('uploads/images/original/' . $this->photo_2) : null;
    }

    /**
     * append photo_1 with path.
     */
    public function getphoto3PathAttribute()
    {
        return $this->photo_3 ? asset('uploads/images/original/' . $this->photo_3) : null;
    }


    /**
     * append 1/0 if exist cart.
     */
    public function getIsInCartAttribute()
    {
        if (auth()->user()) {

            if (in_array($this->attributes['id'], auth()->user()->cart->pluck('id')->toArray())) {

                return $this->attributes['is_in_cart'] = 1;
            }
        }
        return $this->attributes['is_in_cart'] = 0;
    }

    /**
     * append 1/0 if exist wishlist.
     */
    public function getIsFavAttribute()
    {
        if (auth()->user()) {

            if (in_array(auth()->id(), $this->wishlistable->pluck('user_id')->toArray())) {

                return $this->attributes['is_fav'] = 1;
            }
        }

        if (auth('api')->user()) {

            if (in_array(auth()->id(), $this->wishlistable->pluck('user_id')->toArray())) {

                return $this->attributes['is_fav'] = 1;
            }
        }

        return $this->attributes['is_fav'] = 0;
    }

    /**
     * append 1/0 if exist wishlist.
     */
    public function getPriceAttribute()
    {
        return $this->attributes['sale_price'] ? $this->sale_price : $this->regular_price;
    }

    /**
     * append rateing for product.
     */
    public function getRateAttribute()
    {
        if ($this->reviewsProduct()) {

            return $this->attributes['rate'] = $this->reviewsProduct()->avg('rate');
        }

        return $this->attributes['rate'] = 0;
    }

    #################################################################################
    ################################### Relations ###################################
    #################################################################################

    /**
     * Get Categories for product.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    /**
     * Get Colors for product.
     */
    public function color()
    {
        return $this->belongsTo('App\Models\Color', 'color_id', 'id');
    }

    /**
     * Get Sizes for product.
     */
    public function size()
    {
        return $this->belongsTo('App\Models\Size', 'size_id', 'id');
    }

    /**
     * Get Styles for product.
     */
    public function style()
    {
        return $this->belongsTo('App\Models\Style', 'style_id', 'id');
    }

    /**
     * Get Brands for product.
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }

    /**
     * Get Weights for product.
     */
    public function weight()
    {
        return $this->belongsTo('App\Models\Weight', 'weight_id', 'id');
    }

    /**
     * Get Reviews for product.
     */
    public function reviews()
    {
        return $this->belongsToMany('App\Models\User', 'product_reviews', 'product_id', 'user_id')->withPivot(['rate', 'comment']);
    }

    /**
     * Get Colors for product.
     */
    public function reviewsProduct()
    {
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id');
    }

    /**
     * Get Users for the product.
     */
    public function wishlistable()
    {
        return $this->morphMany('App\Models\Wishlist', 'wishlistable');
    }


    #################################################################################
    ################################### Functions ###################################
    #################################################################################

    /**
     * Get Sale or Regular Price.
     */
    public function price()
    {
        return $this->attributes['sale_price'] ? $this->attributes['sale_price'] : $this->attributes['regular_price'];
    }

    /**
     * Deprecated.
     */
    public function avgReview()
    {
        return 3;
    }

    /**
     * Deprecated.
     */
    public function quantityPrice()
    {
        return $this->pivot->quantity * $this->price();
    }

    #################################################################################
    ################################### Scopes ######################################
    #################################################################################

    /**
     * Scope a query to only include offers products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOffers($query)
    {
        $query->where('offer', '!=',  null);
    }

    /**
     * Scope a query to only include active products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    // public function cartProductThrough()
    // {
    //     return $this->hasManyThrough('App\Models\CartProducts', 'App\Models\Cart');
    // }

}
