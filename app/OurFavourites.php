<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OurFavourites extends Model
{
    protected $table = 'our_favourites';

    protected $fillable = ['title','image'];

}
