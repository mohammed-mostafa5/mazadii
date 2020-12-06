<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use App\Helpers\ImageUploaderTrait;

/**
 * Class slider
 * @package App\Models
 * @version June 4, 2020, 12:06 pm UTC
 *
 * @property string $photo
 * @property string $title
 * @property string $description
 * @property string $link
 * @property integer $status
 * @property integer $sort
 */
class Slider extends Model
{
    use SoftDeletes, Translatable, ImageUploaderTrait;

    public $table = 'sliders';


    protected $dates = ['deleted_at'];

    public $translatedAttributes =  ['title', 'subtitle', 'content'];


    public $fillable = [
        'in_order_to',
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
        'in_order_to' => 'integer',
        'photo' => 'string',
        'content' => 'string',
        'status' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];


    /**
     * Validation rules
     *
     * @var array
     */
    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.content'] = '';
        }

        $rules['status'] = 'required|in:Active,inactive';
        $rules['photo'] = 'required|image|mimes:jpeg,jpg,png';

        return $rules;
    }

    public function setPhotoAttribute($file)
    {
        if ($file) {
            try {
                //code...
                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 1920, 358);

                $this->attributes['photo'] = $fileName;
            } catch (\Throwable $th) {
                //throw $th;
                $this->attributes['photo'] = $file;
            }
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

    // In Order To ///////////////////////////

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function scopeInOrderToWeb($query)
    {
        return $query->orderBy('in_order_to', 'desc');
    }


    // In Order To ///////////////////////////
}
