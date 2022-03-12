<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    use HasFactory;
    protected $fillable = [
        "lab_class",
        "room",
        "description",
        "status",
        "department_id",
    ];
    public function department()
    {
        return $this->belongsTo(department::class, "department_id", "id");
    }
}
