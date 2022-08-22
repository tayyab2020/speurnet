<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\saved_place_to_do_contents;

class place_to_do_content extends Model
{
    protected $table = 'place_to_do_content';
	public $timestamps = false;

    public function savings() {
        return $this->hasMany(saved_place_to_do_contents::class, 'content_id','id');
    }
    
}
