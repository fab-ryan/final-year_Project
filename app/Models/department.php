<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\course;

class department extends Model
{
    use HasFactory;
    protected $fillable = ["abbr", "description", "setting_id"];
    public function course()
    {
        return $this->hasMany(course::class);
    }
    public function level()
    {
        return $this->hasMany(level::class);
    }
    public function classRoom()
    {
        return $this->hasMany(classRoom::class);
    }
    public function lecture_assignment()
    {
        return $this->hasMany(lecture_assignment::class);
    }
}
