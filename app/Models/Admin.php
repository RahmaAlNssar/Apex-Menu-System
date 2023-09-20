<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as authenticatable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Admin extends authenticatable
{
    use HasFactory;
    use HasRoles;
    use HasApiTokens;
    //protected $guard_name = 'api';
    protected $fillable = ['owner_name', 'restaurant_code', 'is_admin', 'email', 'token', 'restaurant_name', 'address', 'start_reg', 'end_reg', 'price_reg', 'password', 'phone_restaurant', 'phone_owner', 'facebook', 'insta', 'snapchat', 'theme_id', 'subscription_id', 'added_by', 'status'];

    public const USER_STATUS_ACTIVE = 1;
    public function status()
    {

        return  $this->status == self::USER_STATUS_ACTIVE
            ? 'Active'
            : 'None Active';
    }

    public function end_reg()
    {

        return  $this->end_reg >= now()->format('Y-m-d')
            ? 'Active'
            : 'None Active';
    }


    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
    public function codes()
    {
        return $this->hasMany(Code::class);
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
