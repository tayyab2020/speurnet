<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyTiles extends Model
{
    protected $table = 'company_tiles';

    public function details()
    {
        return $this->hasMany(CompanyTilesDetails::class, 'tile_id','id');
    }
}
