<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestBike extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'purpose_of_funding',
        'user_id',
        'total_funds',
        'request_document',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function projectUpdate()
    {
        return $this->hasMany(ProjectUpdate::class,'project_id' ,'id');
    }
}
