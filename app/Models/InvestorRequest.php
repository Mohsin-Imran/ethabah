<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'time_of_investment', 'investment_fund', 'start_of_period', 'end_of_period'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function investmentFund()
    {
        return $this->belongsTo(InvestorFunds::class,'investor_funds_id');
    }
}
