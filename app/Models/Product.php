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
    use SoftDeletes, ImageUploaderTrait;

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
     * Fillable attributes.
     *
     * @var array
     */
    public $fillable = [
        'category_id',
        'name',
        'description',
        'admin_id',
        'start_price',
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
        'photo' => 'string'
    ];

   /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|min:3',
        'description' => 'required|string|min:3',
        'start_bid_price' => 'required',
        'min_bid_price' => 'required',
        'category_id' => 'required',
    ];


    #################################################################################
    ################################### Appends #####################################
    #################################################################################

    protected $appends = ['is_fav', 'is_in_cart', 'rate', 'first_photo'];

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
     * append rateing for product.
     */
    public function getRateAttribute()
    {
        if ($this->reviewsProduct()) {

            return $this->attributes['rate'] = $this->reviewsProduct()->avg('rate');
        }

        return $this->attributes['rate'] = 0;
    }

    /**
     * append firs photo for product.
     */
    public function getFirstPhotoAttribute()
    {
        $gallery = $this->gallery;
        foreach ($gallery as $item) {
            return $this->attributes['first_photo'] = $item->photo;
        }
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
     * Get Colors for product.
     */
    public function gallery()
    {
        return $this->hasMany('App\Models\ProductGallery', 'product_id', 'id');
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
     * Scope a query to only include active products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
