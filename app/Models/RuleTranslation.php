<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleTranslation extends Model
{
    protected $table = 'rule_translations';

    protected $primaryKey = 'id';

    protected $fillable = ['title', 'description'];

    public $timestamps = false;
}
