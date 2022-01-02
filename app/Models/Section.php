<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model 
{

    use HasTranslations;
    protected $translatable = ['Name_sections'];

    protected $fillable = ['Name_sections','status'];
    protected $table = 'Sections';
    public $timestamps = true;

    public function Grades()
    {
        return $this->belongsTo('Grade', 'Grade_id');
    }

    public function Class()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

}