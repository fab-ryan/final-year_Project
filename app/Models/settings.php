<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;

    protected $fillable = [
        "system_name",
        "current_session",

        "term_begins",
        "term_ends",
    ];
    public function level()
    {
        return $this->hasMany(level::class);
    }
    public function getByKey($key)
    {
        return $this->where("session_name", $key)->first()->value;
    }
}
