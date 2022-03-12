<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    protected $fillable = [
        "course_code",
        "course_name",
        "course_credit",
        "hours_per_week",
        "department_id",
        "level_id",
        "setting_id",
        "semester_id",
        "room_id",
    ];
    public function department()
    {
        return $this->belongsTo(department::class, "department_id", "id");
    }
    public function classRoom()
    {
        return $this->hasMany(classRoom::class);
    }
    public function level()
    {
        return $this->belongsTo(level::class, "level_id", "id");
    }
    public function room()
    {
        return $this->belongsTo(room::class, "room_id", "id");
    }
    public function setting()
    {
        return $this->belongsTo(settings::class, "setting_id", "id");
    }
    public function semester()
    {
        return $this->belongsTo(semester::class, "semester_id", "Se_id");
    }
}
