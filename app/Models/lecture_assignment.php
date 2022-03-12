<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lecture_assignment extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "department_id", "level_id"];
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function department()
    {
        return $this->belongsTo(department::class, "department_id", "id");
    }
}
