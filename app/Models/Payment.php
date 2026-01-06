<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Trait\Searchable;
use App\Casts\MoneyCast;

class Payment extends Model
{

    use Searchable;

    protected $searchableColumns = [
        'motif',
    ];

    protected $searchInRelations = [
        'employee' => ['firstName', 'middleName', 'lastName'],
    ];

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
        'netSalary' => MoneyCast::class,
    ];

    protected $attributes = [
        'netSalary' => 0,
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
