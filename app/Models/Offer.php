<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_tr','name_en','name_ku','first_title_ar','first_title_tr','first_title_en','first_title_ku','second_title_ar','second_title_tr','second_title_en','second_title_ku','third_title_ar','third_title_en','third_title_ku','third_title_tr','start_date','end_date'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
