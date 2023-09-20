<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['comment','rating_service','rating_hygiene','rating_staff','email','phone'];

    public function contact()
    {
        return $this->phone != null ? $this->phone : $this->email;
    }
}
