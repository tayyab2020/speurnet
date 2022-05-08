<?php

namespace App;
use App\categories;

use Illuminate\Database\Eloquent\Model;

class companies extends Model
{
    protected $table = 'companies';
    public $timestamps = false;
    protected $fillable = ['category_ids','title','image','address'];

    public function getCategoriesAttribute()
    {
        $ids = $this->getOriginal('category_ids');
        return categories::whereIn('id', explode(',', $ids))->get();
    }

}
