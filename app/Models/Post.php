<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // protected $fillable = [

    //     'title',
    //     'body',
    //     'post_image'

    // ];


    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function setPostImageAttribute($value)
    {
        $this->attributes['post_image'] = asset($value);
    }

    public function getPostImageAttribute($value)
    {
        return asset($value);
    }


}
