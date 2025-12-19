<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    protected $fillable = [
        'employee_id', 
        'amount', 
        'toRefund', 
        'user_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'toRefund' => 'decimal:2',
    ];

    //RelationShips
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
