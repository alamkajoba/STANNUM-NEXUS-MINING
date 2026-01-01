<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Trait\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FunctionType extends Model
{
    use Searchable;
    use HasFactory;
    
    protected $searchableColumns = ['nameFunction'];

    protected $fillable = [
        'nameFunction', 
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

    public function enrollment()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
