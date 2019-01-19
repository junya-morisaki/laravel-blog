<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends  Authenticatable//変更
{
  protected $fillable = [
       'name', 'email', 'password',
   ];

   protected $hidden = [
       'password', 'remember_token',
   ];

}
