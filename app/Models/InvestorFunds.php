<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorFunds extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'investment_fund_companies');
    }
    public function investmentFundCompanies()
    {
        return $this->hasMany(InvestmentFundCompany::class, 'investor_funds_id', 'id');
    }
    public function investments()
    {
        return $this->hasMany(InvestorRequest::class, 'investor_funds_id', 'id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'investor_funds_id', 'id');
    }
}
