<?php

namespace App;

use App\Enquire;
use Illuminate\Database\Eloquent\Model;
use App\request_viewings;

class Properties extends Model
{
    protected $table = 'properties';

    protected $fillable = ['user_id','available_immediately','views','property_name','property_type','property_purpose','sale_price','rent_price','address','map_latitude','map_longitude','bathrooms','bedrooms','area','description','featured_image'];

    /*protected static function boot()
    {
        parent::boot();
        static::retrieved(function ($model) {});
    }*/

    public function scopeSearchByKeyword($query,$type,$purpose,$price,$min_price,$max_price,$min_area,$max_area,$bathrooms,$bedrooms)
    {

        $query = $query->where("property_type", "$type")
            ->where("property_purpose", "$purpose");


        if($min_price)
        {
            $query->whereRaw("$price >= $min_price");
        }
        if($max_price)
        {

            $query->whereRaw("$price <= $max_price");
        }
        if($min_area)
        {
            $query->where("area" ,'>=', $min_area);
        }
        if($max_area)
        {
            $query->where("area" ,'<=', $max_area);
        }
        if($bathrooms)
        {
            $query->where("bathrooms", "$bathrooms");
        }
        if($bedrooms)
        {
            $query->where("bedrooms", "$bedrooms");
        }


        return $query;
    }

    public function enquiries() {
        return $this->hasMany(Enquire::class, 'property_id','id');
    }

    public function viewings() {
        return $this->hasMany(request_viewings::class, 'property_id','id');
    }

}
