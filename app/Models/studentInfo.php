<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",

        "phone_number",
        "regno",
        "department_id",
        "level_id",
        "class_rooms_id",
        "setting_id",
    ];
    public function level()
    {
        return $this->belongsTo(level::class, "level_id", "id");
    }
    public function classroom()
    {
        return $this->belongsTo(classRoom::class, "class_rooms_id", "id");
    }
    public function department()
    {
        return $this->belongsTo(department::class, "department_id", "id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function setting()
    {
        return $this->belongsTo(settings::class, "setting_id", "id");
    }
}
