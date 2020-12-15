<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserTransactions extends Model
{
    use ImageUploaderTrait;

    public $table = 'user_transactions';


    public $fillable = [
        'user_id',
        'value',
        'action',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'value' => 'integer',
        'action' => 'string',
    ];

    public static $rules = [];
}
