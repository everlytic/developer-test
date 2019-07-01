<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserListing extends Model
{
    use SoftDeletes;
    protected $fillable = ['first_name', 'last_name', 'email', 'position'];
}
