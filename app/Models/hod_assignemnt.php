<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hod_assignemnt extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "department_id"];
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function department()
    {
        return $this->belongsTo(department::class, "department_id", "id");
    }
    protected function course()
    {
        return $this->belongsTo(course::class, "course_id", "id");
    }
}
