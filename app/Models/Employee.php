<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        //Personnal info and profil
        'firstName', 
        'middleName', 
        'lastName', 
        'birthDate', 
        'birthTown', 
        'gender', 
        'phone', 
        'emergencyPhone', 
        'mail', 
        'address', 
        'nationality',
        
        //Personnal info and profil
        'matricule', 
        'proMail',
        'category_id', 
        'user_id',
        'proPhone',
        'jobTitle',
        'affectation',
    ];

    //RelationShips
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function familyState()
    {
        return $this->hasMany(familyState::class);
    }

    public function advence()
    {
        return $this->hasOne(Advence::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
