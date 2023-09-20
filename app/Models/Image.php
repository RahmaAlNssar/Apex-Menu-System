<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['image','item_id','category_id','admin_id'];

    public function item()
    {
        return  $this->belongsTo(Item::class);
    }

    public function admins()
    {
        return  $this->belongsTo(Admin::class);
    }
    public function category()
    {
        return  $this->belongsTo(Category::class);
    }

    public function getItemUrlAttribute(){
        if(isset($this->image ) && $this->image != ''){
            return asset('storage/uploads/items/'.$this->image);
        }

    }

    public function getCategoryUrlAttribute(){
        if(isset($this->image ) && $this->image != ''){
            return asset('storage/uploads/categories/'.$this->image);
        }

    }

    public function getOfferUrlAttribute(){
        if(isset($this->image ) && $this->image != ''){
            return asset('storage/uploads/offers/'.$this->image);
        }

    }
}
