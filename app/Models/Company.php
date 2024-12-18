<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'register_num',
        'phone',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedCompanies()
    {
        return $this->hasMany(AssignedCompany::class);
    }
}
