<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = ['code','expired_at','admin_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function status(){
        if(is_null($this->expired_at)){
            return "Active";
        }else{
            "None Active";
        }

   }

}
