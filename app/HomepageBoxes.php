<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomepageBoxes extends Model
{
    protected $table = 'homepage_boxes';

    protected $fillable = ['title','image'];

}
