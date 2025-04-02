<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        "telegram_id",
        "level",
        "exp",
        "limit_exp",
        "coins",
        "diamonds",
        "ticket",
        "favorite_pages",
        "favorite_pages_purchased",
    ];

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
}
