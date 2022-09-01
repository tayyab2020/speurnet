<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\studies_features;
use App\studies_links;

class studies extends Model
{
    protected $table = 'studies';

    public function features() {
        return $this->hasMany(studies_features::class, 'study_id','id');
    }

    public function links() {
        return $this->hasMany(studies_links::class, 'study_id','id');
    }

}
