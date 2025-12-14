<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $fillable = [
        'CNSS', 'INPP', 'ONEM', 
        'IPR','refundAdvanceAmount', 'deductionSalary',
        'user_id'
    ];
}
