<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\saved_zoekhet;

class zoekhet extends Model
{
    protected $table = 'zoekhet';
	public $timestamps = false;

    public function savings() {
        return $this->hasMany(saved_zoekhet::class, 'content_id','id');
    }
    
}
