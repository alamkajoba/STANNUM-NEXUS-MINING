<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'employee_id', 
        'motif', 
        'totalAmount', 
        'netAmount', 
        'restDay', 
        'overtimes',
        'overtimesPay ',
        'assudityBonus',  
        'riskBonus', 
        'performanceBonus', 
        'CNSS', 
        'INPP', 
        'ONEM', 
        'IPR',
        'refundAdvanceAmount',  
        'deductionSalary',
        'user_id'
    ];

    protected $casts = [
        'totalAmount' => 'decimal:2', 
        'netAmount' => 'decimal:2', 
        'overtimesPay' => 'decimal:2', 
        'assudityBonus' => 'decimal:2',  
        'riskBonus' => 'decimal:2',
        'performanceBonus' => 'decimal:2', 
    ];

    //RelationShips
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
