<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nameCategory', 'amount', 'dayAmount', 'hourAmount', 'workDay', 
        'lunch', 'transportationCost', 'user_id'
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
