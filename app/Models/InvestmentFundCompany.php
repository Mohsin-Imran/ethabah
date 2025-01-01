<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentFundCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_funds_id',
        'company_id',
    ];

    // Define the relationship with the InvestorFunds model
    public function investorFund()
    {
        return $this->belongsTo(InvestorFunds::class, 'investor_funds_id');
    }

    // Define the relationship with the Company model
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // public function companies()
    // {
    //     return $this->belongsToMany(Company::class, 'investment_fund_companies');
    // }

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function investmentFund() {
        return $this->belongsTo(InvestorFunds::class);
    }
}