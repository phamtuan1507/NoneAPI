<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';

    protected $fillable = [
        'name', 'position', 'description', 'image', 'exp', 'phone', 'email',
        'facebook', 'twitter', 'instagram', 'github', 'website'
    ];

    // Quan hệ one-to-many với skills
    public function skills()
    {
        return $this->hasMany(StaffSkill::class);
    }
}
