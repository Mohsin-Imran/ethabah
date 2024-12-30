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
        'register_certificate',
        'commercial_certificate',
        'licenses',
        'address',
        'user_id',
    ];

    public function requestBikes()
    {
        return $this->hasMany(RequestBike::class, 'company_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requestBike()
    {
        return $this->belongsTo(RequestBike::class);
    }

    public function assignedCompanies()
    {
        return $this->hasMany(AssignedCompany::class);
    }

    public function investorFunds()
    {
        return $this->belongsToMany(InvestorFunds::class, 'investment_fund_companies');
    }

}
