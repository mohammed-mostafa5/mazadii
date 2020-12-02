<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable, SoftDeletes, ImageUploaderTrait;

    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        // register
        'first_name',
        'last_name',
        'username',
        'code',
        'verify_code',
        'phone',
        'address',
        'email',
        'password',
        'email_verified_at',
        'photo',
        'identification',
        'approved_at'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * The attributes that should be Validations for arrays.
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'phone' => 'required',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'address' => 'required',
        'about_me' => '',
        'type' => 'required',
        'g-recaptcha-response'   => 'required',
    ];

    /**|numeric
     * Set the user's password
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if ($value) {
            // $this->attributes['password'] = bcrypt($value);
            $this->attributes['password'] = Hash::make($value);
        }
    }


    public function setPhotoAttribute($file)
    {
        if ($file) {
            if (is_array($file)) {

                foreach ($file as $f) {
                    $fileName = $this->createFileName($f);

                    $this->originalImage($f, $fileName);

                    $this->thumbImage($f, $fileName);

                    $this->attributes['photo'] = $fileName;
                }
            } else {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName);

                $this->attributes['photo'] = $fileName;
            }
        }
    }



        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    #################################################################################
    ################################### Appends #####################################
    #################################################################################


    protected $appends = ['photo_path'];

    public function getPhotoPathAttribute()
    {
        return $this->photo ? asset('uploads/images/original/' . $this->photo) : null;
    }

    #################################################################################
    ################################### Relations ###################################
    #################################################################################

    /**
     * Get all of the products for user in wishlist.
     */
    public function wishlist()
    {
        return $this->belongsToMany('App\Models\Product', 'wishlists', 'user_id', 'wishlistable_id');
        // return $this->morphToMany('App\Models\Wishlist', 'favoriteable_id');
    }

    /**
     * Get all of the products for user in cart.
     */
    public function cart()
    {
        return $this->belongsToMany('App\Models\Product', 'carts', 'user_id', 'product_id');
    }

    /**
     * Get area for user.
     */
    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'area_id', 'id');
    }

    #################################################################################
    ################################### Functions ###################################
    #################################################################################

    /**
     * Grapping Wishlist Products.
     *
     */
    public function whishlistProduct()
    {
        if (isset(auth()->user()->wishlist)) {
            return auth()->user()->wishlist;
        }
        return array();
    }


    /**
     * Grapping Cart Products
     *
     */
    public function cartProduct()
    {
        if (isset(auth()->user()->cart)) {
            return auth()->user()->cart;
        }
        return array();
    }


    #################################################################################
    ################################### Functions ###################################
    #################################################################################

    public function getStatusAttribute()
    {
        return $this->attributes['status'] ? 'Active' : 'Inactive';
    }
}
