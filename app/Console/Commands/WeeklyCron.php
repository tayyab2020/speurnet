<?php

namespace App\Console\Commands;

use App\New_Constructions;
use App\Properties;
use App\savedPropertyAlert;
use Illuminate\Console\Command;
use Mail;
use Crypt;

class WeeklyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekly:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weekly Cron job for Properties alerts.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $propertiesalerts = savedPropertyAlert::where('type','2')->where('search_type','1')->get();

        foreach ($propertiesalerts as $key=>$propertyalert){

            $type = $propertyalert->property_type;
            $purpose = $propertyalert->property_purpose;
            $min_price = $propertyalert->min_price;
            $max_price = $propertyalert->max_price;
            $min_area = $propertyalert->min_area;
            $max_area = $propertyalert->max_area;
            $address = $propertyalert->address;
            $address_latitude = $propertyalert->latitude;
            $address_longitude = $propertyalert->longitude;
            $radius = $propertyalert->radius;
            $bedrooms = $propertyalert->bedrooms;
            $bathrooms = $propertyalert->bathrooms;
            $type_of_construction = $propertyalert->type_of_construction;
            $keywords = $propertyalert->keywords;
            $wheelchair = $propertyalert->wheelchair;
            $properties_ids = $propertyalert->properties_ids;
            $properties_search = [];
            $ids = [];

            if($properties_ids != '0')
            {
                $properties_ids = json_decode($properties_ids);
            }


            if($purpose=='Rent')
            {
                $price='rent_price';

            }
            else
            {
                $price='sale_price';
            }

            $properties = Properties::SearchByKeyword($type,$purpose,$price,$min_price,$max_price,$min_area,$max_area,$bathrooms,$bedrooms,$type_of_construction,$keywords)->where('is_sold',0)->where('is_rented',0)->where('wheelchair',$wheelchair)->select('properties.*');


            if($address && $address_latitude && $address_longitude)
            {

                if($radius != 0)
                {
                    foreach ($properties->get() as $key)
                    {
                        $property_latitude = $key->map_latitude;
                        $property_longitude = $key->map_longitude;


                        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($address_latitude).",".urlencode($address_longitude)."&destinations=".urlencode($property_latitude).",".urlencode($property_longitude)."&key=AIzaSyDFPa3LVeBRpaGafuUtk4znrty6IIqtMUw";

                        $result_string = file_get_contents($url);
                        $result = json_decode($result_string, true);

                        if($result['rows'][0]['elements'][0]['status'] == 'OK')
                        {
                            $property_radius = $result['rows'][0]['elements'][0]['distance']['value'];
                            $property_radius = $property_radius / 1000;

                            $property_radius = round($property_radius);


                            if($property_radius <= $radius)
                            {
                                array_push($properties_search,$key);
                                array_push($ids,$key->id);
                            }
                        }


                    }

                    $properties = $properties_search;

                }
                else
                {
                    $properties = $properties->leftjoin('cities','cities.id','=','properties.city_id')->where('cities.city_name', 'like', '%' . $address . '%')->get();
                    foreach ($properties as $key){ array_push($ids,$key->id); }
                }

            }
            else if($address)
            {
                $properties = $properties->leftjoin('cities','cities.id','=','properties.city_id')->where('cities.city_name', 'like', '%' . $address . '%')->get();
                foreach ($properties as $key){ array_push($ids,$key->id); }
            }
            else
            {
                $properties = $properties->get();
                foreach ($properties as $key){ array_push($ids,$key->id); }
            }

            if(($properties_ids == '0') || !($ids === array_intersect($ids, $properties_ids) && $properties_ids === array_intersect($properties_ids, $ids)))
            {
                $propertyalert->properties_ids = $ids;
                $propertyalert->save();

                $sender_email = $propertyalert->user_email;
                $id = $propertyalert->id;
                $encrypted_id = Crypt::encrypt($id);

                Mail::send('emails.propertiesAlert',
                    array(
                        'properties' => $properties,
                        'parameters' => $propertyalert,
                        'type' => 2,
                        'id' => $encrypted_id
                    ),  function ($message) use($properties,$sender_email) {
                        $message->from(getcong('site_email'),getcong('site_name'));
                        $message->to($sender_email)
                            ->subject('Weekly Properties Alert based on your saved search by ' . getcong('site_name'));
                    });

            }

        }


        $propertiesalerts = savedPropertyAlert::where('type','2')->where('search_type','2')->get();

        foreach ($propertiesalerts as $key=>$propertyalert){

            $type = $propertyalert->property_type;
            $purpose = 'Sale';
            $min_price = $propertyalert->min_price;
            $max_price = $propertyalert->max_price;
            $min_area = $propertyalert->min_area;
            $max_area = $propertyalert->max_area;
            $address = $propertyalert->address;
            $address_latitude = $propertyalert->latitude;
            $address_longitude = $propertyalert->longitude;
            $radius = $propertyalert->radius;
            $bedrooms = $propertyalert->bedrooms;
            $bathrooms = $propertyalert->bathrooms;
            $kind_of_type = $propertyalert->kind_of_type;
            $keywords = $propertyalert->keywords;
            $wheelchair = $propertyalert->wheelchair;
            $properties_ids = $propertyalert->properties_ids;
            $properties_search = [];
            $ids = [];

            if($properties_ids != '0')
            {
                $properties_ids = json_decode($properties_ids);
            }


            if($kind_of_type=='For Sale')
            {
                $price='sale_price';
            }
            else if($kind_of_type=='To Rent Social' || $kind_of_type=='To Rent Free')
            {
                $price='rent_price';
            }

            $properties = New_Constructions::SearchByKeyword($type,$purpose,$price,$min_price,$max_price,$min_area,$max_area,$bathrooms,$bedrooms,$kind_of_type,$keywords)->where('is_sold',0)->where('is_rented',0)->where('wheelchair',$wheelchair)->select('properties.*');


            if($address && $address_latitude && $address_longitude)
            {

                if($radius != 0)
                {
                    foreach ($properties->get() as $key)
                    {
                        $property_latitude = $key->map_latitude;
                        $property_longitude = $key->map_longitude;


                        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($address_latitude).",".urlencode($address_longitude)."&destinations=".urlencode($property_latitude).",".urlencode($property_longitude)."&key=AIzaSyDFPa3LVeBRpaGafuUtk4znrty6IIqtMUw";

                        $result_string = file_get_contents($url);
                        $result = json_decode($result_string, true);

                        if($result['rows'][0]['elements'][0]['status'] == 'OK')
                        {
                            $property_radius = $result['rows'][0]['elements'][0]['distance']['value'];
                            $property_radius = $property_radius / 1000;

                            $property_radius = round($property_radius);


                            if($property_radius <= $radius)
                            {
                                array_push($properties_search,$key);
                                array_push($ids,$key->id);
                            }
                        }


                    }

                    $properties = $properties_search;

                }
                else
                {
                    $properties = $properties->leftjoin('cities','cities.id','=','properties.city_id')->where('cities.city_name', 'like', '%' . $address . '%')->get();
                    foreach ($properties as $key){ array_push($ids,$key->id); }
                }

            }
            else if($address)
            {
                $properties = $properties->leftjoin('cities','cities.id','=','properties.city_id')->where('cities.city_name', 'like', '%' . $address . '%')->get();
                foreach ($properties as $key){ array_push($ids,$key->id); }
            }
            else
            {
                $properties = $properties->get();
                foreach ($properties as $key){ array_push($ids,$key->id); }
            }

            if(($properties_ids == '0') || !($ids === array_intersect($ids, $properties_ids) && $properties_ids === array_intersect($properties_ids, $ids)))
            {
                $propertyalert->properties_ids = $ids;
                $propertyalert->save();

                $sender_email = $propertyalert->user_email;
                $id = $propertyalert->id;
                $encrypted_id = Crypt::encrypt($id);

                Mail::send('emails.propertiesAlert',
                    array(
                        'properties' => $properties,
                        'parameters' => $propertyalert,
                        'type' => 2,
                        'id' => $encrypted_id
                    ),  function ($message) use($properties,$sender_email) {
                        $message->from(getcong('site_email'),getcong('site_name'));
                        $message->to($sender_email)
                            ->subject('Weekly New Construction Properties Alert based on your saved search by ' . getcong('site_name'));
                    });

            }

        }


        \Log::info("Weekly Cron Job is working fine!");
    }
}
