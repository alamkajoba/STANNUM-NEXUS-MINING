<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Trait\Searchable;

class Enrollment extends Model
{
    use Searchable; 

    // search
    protected $searchableColumns = [
        'section', 'department', 'site', 'proMail', 
        'echelon', 'matricule'
    ];

    // relations
    protected $searchableRelations = [
        'functionType' => ['nameFunction'],
        'employee' => ['firstName', 'middleName', 'lastName',]
    ];

    protected $fillable = [
        'section', 'department', 'site', 'professionalCategory', 
        'echelon', 'matricule', 'startDate', 'proMail', 'proPhone', 
        'employee_id', 'function_type_id', 'acountNumber', 'cnssNumber'
    ];

    protected $casts = [
        'startDate' => 'date',
    ];

    //RelationShips
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function functionType()
    {
        return $this->belongsTo(FunctionType::class, 'function_type_id');
    }
}
