<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nameCategory', 
        'amount',  
        'dayAmount', 
        'hourAmount',  
        'workDay', 
        'lunch', 
        'transportationCost', 
        'user_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'dayAmount' => 'decimal:2',
        'hourAmount' => 'decimal:2',
        'lunch' => 'decimal:2',
        'transportationCost' => 'decimal:2',
    ];



    //RelationShips
    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
