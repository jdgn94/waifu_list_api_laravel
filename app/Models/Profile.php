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

    protected $appends = ["total_characters", "total_points"];

    protected function getTotalCharactersAttribute()
    {
        return CharacterList::where("user_id", $this->user_id)->count("id");
    }

    protected function getTotalPointsAttribute()
    {
        return CharacterList::where("user_id", $this->user_id)->sum("points");
    }

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
}
