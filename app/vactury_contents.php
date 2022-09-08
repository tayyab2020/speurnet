<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vactury_contents extends Model
{
    protected $table = 'vactury_contents';
	public $timestamps = false;

    public function getProvincesAttribute()
    {
        $ids = $this->getOriginal('provinces');
        return vactury_provinces::whereIn('id', explode(',', $ids))->get();
    }
    
}
