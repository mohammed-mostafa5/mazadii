<?php

namespace App\Models;

use Eloquent as Model;
use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Deposit;
use Illuminate\Support\Facades\Auth;

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
        'user_id',
        'winner_id',
        'name',
        'description',
        'specifications',
        'issues',
        'start_bid_price',
        'highest_value',
        'min_bid_price',
        'min_price',
        'number_of_items',
        'watched_count',
        'end_at',
        'status',
        'code',
        'approved_at',
        'deposit',
        'electricity_bill',
        'gas_bill',
        'identification'
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
        'photos' => 'required|array|min:6',
        'photos.*' => 'image',

    ];

    #################################################################################
    ################################### Appends #####################################
    #################################################################################

    protected $appends = ['is_fav', 'first_photo', 'total_bids', 'check_deposit', 'is_winner'];

    public function getFirstPhotoAttribute()
    {
        $gallery = $this->gallery;
        foreach ($gallery as $item) {
            return $this->attributes['first_photo'] = $item->photo;
        }
    }

    public function getIsWinnerAttribute()
    {
        $user = auth('api')->user();

        if ($user) {
            if ($user->id == $this->attributes['winner_id']) {
                return true;
            }
        }
        return false;
    }

    public function getIsFavAttribute()
    {
        $user = auth('api')->user();

        if ($user) {
            if (in_array($this->attributes['id'], $user->favourites()->pluck('product_id')->toArray())) {
                return $this->attributes['is_fav'] = 1;
            }
        }

        return $this->attributes['is_fav'] = 0;
    }

    public function getCheckDepositAttribute()
    {
        $user = auth('api')->user();
        if (!$user) {
            return false;
        }

        $depositRecord = Deposit::where('product_id', $this->attributes['id'])->where('user_id', auth('api')->id())->first();

        return !!$depositRecord;
    }

    public function getTotalBidsAttribute()
    {
        return $this->attributes['total_bids'] = $this->biders->count();
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

    public function biders()
    {
        return $this->belongsToMany('App\Models\User', 'product_user', 'product_id', 'user_id')->withPivot('id', 'value')->withTimeStamps();
    }

    public function deposit()
    {
        return $this->belongsToMany('App\Models\Deposit', 'product_deposit', 'product_id', 'user_id')->withPivot('deposit')->withTimeStamps();
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function winner()
    {
        return $this->belongsTo('App\Models\User', 'winner_id', 'id');
    }

    public function bids()
    {
        return $this->hasMany('App\Models\Biders', 'product_id', 'id');
    }

    #################################################################################
    ################################### Functions ###################################
    #################################################################################


    #################################################################################
    ############################## Accessors & Mutators #############################
    #################################################################################


    public function getStatusAttribute()
    {

        switch ($this->attributes['status']) {
            case 0:
                return 'Not Approved';
                break;
            case 1:
                return 'Active';
                break;
            case 2:
                return 'Pending';
                break;
            case 3:
                return 'Delivered';
                break;
            case 4:
                return 'Finished';
                break;
            case 5:
                return 'Expired';
                break;

            default:
                return 'Not Approved';
                break;
        }
    }

    public function setElectricityBillAttribute($file)
    {
        if ($file) {

            $fileName = $this->createFileName($file);

            $this->originalImage($file, $fileName);

            $this->thumbImage($file, $fileName);

            $this->attributes['electricity_bill'] = $fileName;
        }
    }

    public function getElectricityBillAttribute($val)
    {

        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }

    public function setGasBillAttribute($file)
    {
        if ($file) {

            $fileName = $this->createFileName($file);

            $this->originalImage($file, $fileName);

            $this->thumbImage($file, $fileName);

            $this->attributes['gas_bill'] = $fileName;
        }
    }

    public function getGasBillAttribute($val)
    {

        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }




    public function setIdentificationAttribute($file)
    {
        try {
            if ($file) {
                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName);

                $this->attributes['identification'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['identification'] = $file;
        }
    }

    public function getIdentificationAttribute()
    {
        return $this->attributes['identification'] ? asset('uploads/images/original/' . $this->attributes['identification']) : null;
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
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopePending($query)
    {
        return $query->where('status', 2);
    }
    public function scopeFinished($query)
    {
        return $query->where('status', 4);
    }
}
