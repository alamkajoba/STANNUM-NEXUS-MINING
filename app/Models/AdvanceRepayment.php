<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvanceRepayment extends Model
{
    protected $fillable = [
        'advance_id',
        'payment_id',
        'amount',
        'user_id',
        'paid_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function advance()
    {
        return $this->belongsTo(Advance::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
