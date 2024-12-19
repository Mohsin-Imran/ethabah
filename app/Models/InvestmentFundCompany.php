<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentFundCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_fund_id',
        'company_id',
    ];

    // Define the relationship with the InvestorFunds model
    public function investorFund()
    {
        return $this->belongsTo(InvestorFunds::class, 'investor_fund_id');
    }

    // Define the relationship with the Company model
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}