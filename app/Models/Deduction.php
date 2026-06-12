<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $fillable = [
        'CNSS', 
        'INPP', 
        'ONEM', 
        'IPR',
        'refundAdvanceAmount',  
        'deductionSalary',
        'user_id'
    ];

    protected $casts = [
        'CNSS' => 'float',
        'INPP' => 'float',
        'ONEM' => 'float',
        'IPR'  => 'float',
        'refundAdvanceAmount' => 'float',
        'deductionSalary'     => 'float',
    ];
}
