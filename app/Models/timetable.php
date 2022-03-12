<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kamaro\TimeTable\Course;

class timetable extends Model
{
    use HasFactory;
    protected $fillable = [
        "timetable_name",
        "department_id",
        "level_id",
        "semester_id",
        "setting_id",
        "schedule",
    ];
    public function department()
    {
        return $this->belongsTo(department::class, "department_id", "id");
    }
    public function level()
    {
        return $this->belongsTo(level::class, "level_id", "id");
    }
    public function setting()
    {
        return $this->belongsTo(settings::class, "setting_id", "id");
    }
    public function semester()
    {
        return $this->belongsTo(semester::class, "semester_id", "Se_id");
    }
    public function alreadyHas($condition)
    {
        return $this->where($condition)->exists();
    }
}
