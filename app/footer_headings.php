<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class footer_headings extends Model
{
    protected $table = 'footer_headings';

    public $timestamps = false;

    public function pages()
    {
        return $this->hasMany('App\footer_pages','heading_id','id');
    }

}
