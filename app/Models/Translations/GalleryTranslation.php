<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['title','description'];

}
