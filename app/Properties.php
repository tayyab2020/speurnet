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

    public function scopeSearchByKeyword($query, $city_id,$type,$purpose,$price,$min_price,$max_price)
    {

        if ($min_price!='' and $max_price!='') {
            $query->where(function ($query) use ($city_id,$type,$purpose,$price,$min_price,$max_price) {
                $query->where("city_id", "$city_id")
                    ->where("property_type", "$type")
                    ->where("property_purpose", "$purpose")
                    ->whereRaw("$price > $min_price")
                    ->whereRaw("$price <= $max_price");


            });
        }
        elseif ($min_price!='') {
            $query->where(function ($query) use ($city_id,$type,$purpose,$price,$min_price,$max_price) {
                $query->where("city_id", "$city_id")
                    ->where("property_type", "$type")
                    ->where("property_purpose", "$purpose")
                    ->whereRaw("$price > $min_price");

            });
        }
        elseif ($max_price!='') {
            $query->where(function ($query) use ($city_id,$type,$purpose,$price,$min_price,$max_price) {
                $query->where("city_id", "$city_id")
                    ->where("property_type", "$type")
                    ->where("property_purpose", "$purpose")
                    ->whereRaw("$price <= $max_price");

            });
        }
        else
        {
			 $query->where(function ($query) use ($city_id,$type,$purpose,$price,$min_price,$max_price) {
                $query->where("city_id", "$city_id")
                    ->where("property_type", "$type")
                    ->where("property_purpose", "$purpose");


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
