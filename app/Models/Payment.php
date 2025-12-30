<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'employee_id', 
        'motif', 
        'user_id',
        //All for paySlip
        'childCount',
        'baseSalary',
        'dayMounth',
        'justifyDay',
        'workDay',
        //payment
        'baseMounthlyDay',
        'overtimesPay',
        //advantage
        'housingDay',
        'housingMounth',
        'transportationCostDay',
        'transportationCostMounth',
        'familialAllocationDay',
        'familialAllocationMounth',
        'totalAdvantage',
        //deduction
        'CNSS',
        'INPP',
        'ONEM',
        'IPR',
        'deductionSalary',
        'refund',
        'CNSSAmount',
        'INPPAmount',
        'ONEMAmount',
        'IPRAmount',
        'deductionSalaryAmount',
        'refundAmount',
        'totalDeduction',
        //final
        'brutSalary',
        'netSalary',
    ];

    protected $casts = [
        'totalAmount' => 'decimal:2', 
        'baseSalary' => 'decimal:2',
        'baseMounthlyDay' => 'decimal:2', 
        'overtimesPay' => 'decimal:2', 
        'housingDay' => 'decimal:2', 
        'housingMounth' => 'decimal:2', 
        'transportationCostDay' => 'decimal:2', 
        'transportationCostMounth' => 'decimal:2', 
        'familialAllocationDay' => 'decimal:2', 
        'familialAllocationMounth' => 'decimal:2', 
        'totalAdvantage' => 'decimal:2', 
        'CNSS' => 'decimal:2', 
        'INPP' => 'decimal:2', 
        'ONEM' => 'decimal:2', 
        'IPR' => 'decimal:2', 
        'deductionSalary' => 'decimal:2', 
        'refund' => 'decimal:2', 
        'CNSSAmount' => 'decimal:2', 
        'INPPAmount' => 'decimal:2', 
        'ONEMAmount' => 'decimal:2', 
        'IPRAmount' => 'decimal:2', 
        'deductionSalaryAmount' => 'decimal:2', 
        'refundAmount' => 'decimal:2', 
        'totalDeduction' => 'decimal:2', 
        'brutSalary' => 'decimal:2', 
        'netSalary' => 'decimal:2', 
        'motif' => 'date', 
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
