<?php

namespace App;
use App\categories_headings;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $table = 'categories';
	public $timestamps = false;

    public function getHeadingsAttribute()
    {
        $ids = $this->getOriginal('heading_ids');
        return categories_headings::whereIn('id', explode(',', $ids))->get();
    }
    
}
