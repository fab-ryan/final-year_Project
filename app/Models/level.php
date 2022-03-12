<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    use HasFactory;
    protected $fillable = ["level_name", "department_id", "setting_id"];
    public function department()
    {
        return $this->belongsTo(department::class, "department_id", "id");
    }
    public function setting()
    {
        return $this->belongsTo(settings::class, "setting_id", "id");
    }
    public function course()
    {
        return $this->hasMany(course::class);
    }
}
