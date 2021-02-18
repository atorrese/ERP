<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable =[
        'names',
        'surnames',
        'address' ,
        'birthdate',
        'phone',
        'identification_card' ,
        'email' ,
    ];

}
