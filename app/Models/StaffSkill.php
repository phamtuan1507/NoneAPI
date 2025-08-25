<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffSkill extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id', 'skill_name', 'percentage', 'description'];

    // Quan hệ thuộc về staff
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
