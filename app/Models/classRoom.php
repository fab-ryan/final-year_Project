<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        "class_name",
        "department_id",
        "course_id",
        "setting_id",
    ];
    protected $guarded = ["id"];
    protected $casts = ["course_id" => "array"];

    public function department()
    {
        return $this->belongsTo(department::class, "department_id", "id");
    }
    protected function course()
    {
        return $this->belongsTo(course::class, "course_id", "id");
    }
}
