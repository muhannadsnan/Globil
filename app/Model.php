<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Model extends Eloquent
{
    // to control which fields of the submitted form are going to be treated when using:  Post::create(request->all());

    protected $guarded = [];

    // or you could do this
    // protected $fillable = ['title', 'body'];
    // We are inheriting from this model in each model to avoid wrighting this field in each model.
}
