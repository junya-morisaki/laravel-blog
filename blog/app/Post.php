<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['user_id','post','title'];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function comments(){
      return $this->hasMany('App\Comment');
    }

    public function fav(){
      return $this->hasOne('App\Fav');
    }

}
