<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CustomUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'customusers';

    /**
     * Set some default attributes for the model
     * We are not really using the password but I left it on the modal and just setting a default value for now
     * @var Array
     */
    protected $attributes = [
        'password'          =>  'default',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname','email','password','position'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Get the Auth password value
     * @return string the password from the model
     */
    public function getAuthPassword()
    {
      return $this->password;
    }
}