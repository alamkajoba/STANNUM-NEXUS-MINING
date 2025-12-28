<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Trait\Searchable;

class Employee extends Model
{
    use Notifiable;

    use Searchable; 

    // search
    protected $searchableColumns = [
        'firstName', 'middleName', 'lastName', 
        'matricule', 'affectation', 'jobTitle'
    ];

    // relations
    protected $searchableRelations = [
        'category' => 'nameCategory'
    ];
    
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

    public function routeNotificationForMail($notification)
    {
        return $this->proMail; 
    }

    // public function routeNotificationForVonage($notification)
    // {
    //     //(format international : 243...)
    //     return $this->proPhone; 
    // }

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

    public function advance()
    {
        return $this->hasOne(Advance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
