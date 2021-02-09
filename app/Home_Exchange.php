<?php

namespace App;

use App\Enquire;
use App\request_viewings;
use Illuminate\Database\Eloquent\Model;

class Home_Exchange extends Model
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
            ->where('new_construction', '=', 0)->where('home_exchange', '=', 1);
    }

    public function scopeSearchByKeyword($query,$house_kind,$bedrooms,$area,$rent,$preferred_house_kind,$preferred_bedrooms,$preferred_area,$preferred_rent,$media)
    {
        if($preferred_house_kind != 0)
        {
            $query = $query->where("property_type", "$preferred_house_kind");
        }

        $query->where("bedrooms", '>=', $preferred_bedrooms);

        var_dump($query->get());
        exit();

        $query->where("rent_per_month" ,'<=', $preferred_rent);

        if($house_kind != 0)
        {
            $query->where("preferred_kind", "$house_kind");
        }

        $query->where("preferred_bedrooms", '<=', $bedrooms);

        $query->where("preferred_rent_max" ,'>=', $rent);

        if($media)
        {
            $query->where("featured_image",'!=',NULL)->orWhere('property_images1','!=',NULL)->orWhere('property_images2','!=',NULL)->orWhere('property_images3','!=',NULL)->orWhere('property_images4','!=',NULL)->orWhere('property_images5','!=',NULL)->orWhere('video','!=',NULL);
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
