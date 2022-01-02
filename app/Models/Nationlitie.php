<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Nationlitie extends Model
{
    use HasTranslations;
    protected $table = 'nationlities';
    public $translatable = ['Name'];
    protected $fillable = ['Name'];
}
