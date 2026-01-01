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

    /**
     * Repayments recorded against this advance
     */
    public function repayments()
    {
        return $this->hasMany(AdvanceRepayment::class);
    }

    // Accessors for backward compatibility
    public function getRemainToPayAttribute()
    {
        return $this->toRefund;
    }

    public function getCreditAmountAttribute()
    {
        return $this->amount;
    }

    // Scope to get active advances (with remaining to refund)
    public function scopeActive($query)
    {
        return $query->where('toRefund', '>', 0);
    }
}
