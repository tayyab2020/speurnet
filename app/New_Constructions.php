<?php

namespace App;

use App\Enquire;
use App\request_viewings;
use Illuminate\Database\Eloquent\Model;

class New_Constructions extends Model
{
    protected $table = 'properties';

    protected $fillable = ['user_id','available_immediately','views','property_name','property_type','property_purpose','sale_price','rent_price','address','map_latitude','map_longitude','bathrooms','bedrooms','area','description','featured_image'];

    /*protected static function boot()
    {
        parent::boot();
        static::retrieved(function ($model) {});
    }*/

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('new_construction', '=', 1);
    }

    public function scopeSearchByKeyword($query,$type,$purpose,$price,$min_price,$max_price,$min_area,$max_area,$bathrooms,$bedrooms,$kind_of_type,$keywords)
    {

        $query = $query->where("property_purpose", "$purpose");


        if($type)
        {
            $query->where("property_type", "$type");
        }


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
        if($kind_of_type)
        {
            $query->where("kind_of_type", "$kind_of_type");
        }
        if($keywords)
        {
            $query->where(function($query) use($keywords) {
                $query->where("keywords",'LIKE', "%$keywords%")
                    ->orWhere("property_slug",'LIKE', "%$keywords%")
                    ->orWhere("property_name",'LIKE', "%$keywords%")
                    ->orWhere("description",'LIKE', "%$keywords%");
            });

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
