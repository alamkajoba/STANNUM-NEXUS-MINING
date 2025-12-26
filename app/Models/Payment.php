<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'employee_id', 
        'motif', 
        'totalAmount', 
        'user_id'
    ];

    protected $casts = [
        'totalAmount' => 'decimal:2', 
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
