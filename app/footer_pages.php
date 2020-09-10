<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class footer_pages extends Model
{
    protected $table = 'footer_pages';

    public function heading(){

        return $this->belongsTo(footer_headings::class);

    }

}
