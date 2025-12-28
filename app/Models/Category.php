<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Trait\Searchable;

class Category extends Model
{

    use Searchable;
    
    protected $searchableColumns = ['nameCategory'];

    protected $fillable = [
        'nameCategory', 
        'amount',  
        'dayAmount', 
        'hourAmount',  
        'workDay', 
        'housing', 
        'transportationCost', 
        'familialAllocation',
        'user_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'dayAmount' => 'decimal:2',
        'hourAmount' => 'decimal:2',
        'housing' => 'decimal:2',
        'familialAllocation' => 'decimal:2',
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
