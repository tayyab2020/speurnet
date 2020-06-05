<?php

namespace App\Console\Commands;

use App\Properties;
use App\savedPropertyAlert;
use App\saveJobAlert;
use Mail;
use Crypt;
use Illuminate\Console\Command;

class DailyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Cron job for Properties alerts.';

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

        $propertiesalerts = savedPropertyAlert::where('type','1')->get();

        foreach ($propertiesalerts as $key=>$propertyalert){

            $type = $propertyalert->type;
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
            $properties_search = [];

            if($purpose=='Rent')
            {
                $price='rent_price';

            }
            else
            {
                $price='sale_price';
            }

            $properties = Properties::SearchByKeyword($type,$purpose,$price,$min_price,$max_price,$min_area,$max_area,$bathrooms,$bedrooms)->where('is_sold',0)->where('is_rented',0)->get();


            if($address && $address_latitude && $address_longitude)
            {
                foreach ($properties as $key)
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
                        }
                    }


                }

                $properties = $properties_search;

            }


            $sender_email = $propertyalert->user_email;
            $title = $propertyalert->title;
            $id = $propertyalert->id;
            $encrypted_id = Crypt::encrypt($id);

            Mail::send('emails.propertiesAlert',
                array(
                    'properties' => $properties,
                    'type' => 1,
                    'title' => $title,
                    'id' => $encrypted_id
                ),  function ($message) use($properties,$sender_email) {
                    $message->from(getcong('site_email'),getcong('site_name'));
                    $message->to($sender_email)
                        ->subject('Daily Properties Alert based on your saved search by ' . getcong('site_name'));
                });
        }


        \Log::info("Daily Cron Job is working fine!");


    }
}
