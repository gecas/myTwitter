<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	
   

    protected $fillable = [
        'title',
        'body',
        'thumbnail',
        'slug',
        'user_id'
    ];

 public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

     public function ratings(){
        return $this->hasOne('App\Rating');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimeStamps();
    }

}
