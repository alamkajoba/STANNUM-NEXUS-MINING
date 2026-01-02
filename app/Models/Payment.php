<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'motif',
        'netSalary',
        'slipPrint'
    ];

    protected $casts = [
        'motif' => 'date',
        'slipPrint' => 'array',
        'netSalary' => 'decimal:2',
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
