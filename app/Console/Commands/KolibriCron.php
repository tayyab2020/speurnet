<?php

namespace App\Console\Commands;

use App\City;
use App\New_Constructions;
use App\Properties;
use App\property_documents;
use App\savedPropertyAlert;
use App\saveJobAlert;
use App\sub_kinds;
use App\sub_property_types;
use App\Types;
use App\User;
use Illuminate\Support\Str;
use Mail;
use Crypt;
use Illuminate\Console\Command;

class KolibriCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kolibri:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kolibri Cron job for Properties.';

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
        ini_set('max_execution_time', '0');

        $ch = curl_init();
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',

        );
        curl_setopt($ch, CURLOPT_URL, 'https://api.wazzupsoftware.com/ActivateService.svc/16/0/b37f7923-b6ZO-46JE-93HU-3442c7c81e76/mediacontract/?state=active');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);

        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $arr = json_decode($json,true);

        foreach($arr['ArrayOfMediaContractSnapshot']['MediaContractSnapshot'] as $k=> $brokers) {

            $check = User::where('email',$brokers['EmailAddress'])->first();

            if($check)
            {
                $check->RealtorID = $brokers['RealtorID'];
                $check->MediaContractID = $brokers['MediaContractID'];
                $check->name = $brokers['Name'];
                $check->address = $brokers['AddressLine1'];
                $check->city = $brokers['CityName'];
                $check->phone = $brokers['PhoneNumber'];

                if(isset($brokers['FaxNumber']))
                {
                    $check->fax = $brokers['FaxNumber'];
                }

                $check->PostalCode = $brokers['PostalCode'];

                if(isset($brokers['Region']))
                {
                    $check->Region = $brokers['Region'];
                }

                if(isset($brokers['SubRegion']))
                {
                    $check->SubRegion = $brokers['SubRegion'];
                }

                if(isset($brokers['CountryCode']))
                {
                    $check->CountryCode = $brokers['CountryCode'];
                }

                if(isset($brokers['WebAddress']))
                {
                    $check->WebAddress = $brokers['WebAddress'];
                }

                $check->save();

                $user_id = $check->id;

            }
            else
            {
                $password = Str::random(10);

                $user = new User;
                $user->name = $brokers['Name'];
                $user->company_name = $brokers['Name'];
                $user->email = $brokers['EmailAddress'];
                $user->usertype = 'Agents';
                $user->password = bcrypt($password);
                $user->status = 1;
                $user->address = $brokers['AddressLine1'];
                $user->city = $brokers['CityName'];
                $user->PostalCode = $brokers['PostalCode'];
                $user->phone = $brokers['PhoneNumber'];

                if(isset($brokers['FaxNumber']))
                {
                    $user->fax = $brokers['FaxNumber'];
                }

                if(isset($brokers['Region']))
                {
                    $user->Region = $brokers['Region'];
                }

                if(isset($brokers['SubRegion']))
                {
                    $user->SubRegion = $brokers['SubRegion'];
                }

                if(isset($brokers['CountryCode']))
                {
                    $user->CountryCode = $brokers['CountryCode'];
                }

                if(isset($brokers['WebAddress']))
                {
                    $user->WebAddress = $brokers['WebAddress'];
                }

                $user->MediaContractID = $brokers['MediaContractID'];
                $user->RealtorID = $brokers['RealtorID'];
                $user->save();

                $user_id = $user->id;
                $user_name = $brokers['Name'];
                $user_email = $brokers['EmailAddress'];

                Mail::send('emails.kolibri_registration',
                    array(
                        'name' => $user_name,
                        'email' => $user_email,
                        'password' => $password
                    ), function($message) use ($user_name,$user_email)
                    {
                        $message->from(getcong('site_email'),getcong('site_name'));
                        $message->to($user_email,$user_name)->subject('Gefeliciteerd, je Zoekjehuisje.nl account is geactiveerd!');
                    });
            }


            $ch = curl_init();
            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json',

            );
            curl_setopt($ch, CURLOPT_URL, 'https://api.wazzupsoftware.com/OutputService.svc/16/0/b37f7923-b6ZO-46JE-93HU-3442c7c81e76/realestatesummary/?realtorid='.$brokers['RealtorID']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_HEADER, 0);

            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Timeout in seconds
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);

            $response = curl_exec($ch);

            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $properties = json_decode($json,true);

            if(array_key_exists(0, $properties['ArrayOfRealEstatePropertySummarySnapshot']['RealEstatePropertySummarySnapshot']))
            {
                $properties = $properties['ArrayOfRealEstatePropertySummarySnapshot']['RealEstatePropertySummarySnapshot'];
            }
            else
            {
                $properties = $properties['ArrayOfRealEstatePropertySummarySnapshot'];
            }

            foreach($properties as $key)
            {
                $modification = $key['ModificationDateTimeUtc'];
                $property_id = $key['RealEstateProperyID'];
                $realtor_id = $key['RealtorID'];
                $property_address = $key['AddressSummary'];

                $ch = curl_init();
                $headers = array(
                    'Accept: application/json',
                    'Content-Type: application/json',

                );
                curl_setopt($ch, CURLOPT_URL, 'https://api.wazzupsoftware.com/OutputService.svc/16/0/b37f7923-b6ZO-46JE-93HU-3442c7c81e76/realestate/?realtorid='.$realtor_id.'&id='.$property_id);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Timeout in seconds
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);

                $response = curl_exec($ch);

                $xml = simplexml_load_string($response);
                $json = json_encode($xml);
                $property_details = json_decode($json,true);

                if(isset($property_details['RealEstateProperty']['Offer']['IsForSale']) || isset($property_details['RealEstateProperty']['Offer']['IsForRent']))
                {
                    $property_name = $property_details['RealEstateProperty']['Location']['Address']['AddressLine1']['Translation'];

                    $property_type = $property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType'][0];

                    $get_property_type = Types::where('type_en',$property_type)->first();

                    $sub_property_type = $property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType'][1];

                    $get_sub_property_type = sub_property_types::where('type_en',$sub_property_type)->first();

                    $sub_property_kind = $property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType'][2];

                    $get_sub_property_kind = sub_kinds::where('type_en',$sub_property_kind)->first();

                    $address = $property_details['RealEstateProperty']['Location']['Address']['PostalCode'] . ' ' . $property_details['RealEstateProperty']['Location']['Address']['CityName']['Translation'];

                    $address_latitude = $property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails'][0]['Coordinates']['Latitude'];

                    $address_longitude = $property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails'][0]['Coordinates']['Longitude'];

                    $bathrooms = $property_details['RealEstateProperty']['Counts']['CountOfBathrooms'];

                    if(isset($property_details['RealEstateProperty']['Counts']['CountOfBedrooms']))
                    {
                        $bedrooms = $property_details['RealEstateProperty']['Counts']['CountOfBedrooms'];
                    }
                    else
                    {
                        $bedrooms = 0;
                    }

                    $area = $property_details['RealEstateProperty']['AreaTotals']['EffectiveArea'];

                    $volume = $property_details['RealEstateProperty']['Dimensions']['Content'];

                    if(is_array($property_details['RealEstateProperty']['Descriptions']['AdText']['Translation']) && array_key_exists(0, $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation']))
                    {
                        $description = $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation'][0] . "\n\n" . $property_details['RealEstateProperty']['Descriptions']['DetailsDescription']['Translation'][0];
                    }
                    else
                    {
                        $description = $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation'] . "\n\n" . $property_details['RealEstateProperty']['Descriptions']['DetailsDescription']['Translation'];
                    }

                    $construction_year_from = $property_details['RealEstateProperty']['Construction']['ConstructionYearFrom'];

                    $construction_year = $property_details['RealEstateProperty']['Construction']['ConstructionYearTo'];

                    $construction_period = $property_details['RealEstateProperty']['Construction']['ConstructionPeriod'];

                    $total_rooms = $property_details['RealEstateProperty']['Counts']['CountOfRooms'];

                    $floors = $property_details['RealEstateProperty']['Counts']['CountOfFloors'];

                    if(isset($property_details['RealEstateProperty']['Gardens']))
                    {
                        $garden_area = $property_details['RealEstateProperty']['Gardens']['Garden']['Dimensions']['Area'] . 'm² (' . $property_details['RealEstateProperty']['Gardens']['Garden']['Dimensions']['Length'] . 'm diep en ' . $property_details['RealEstateProperty']['Gardens']['Garden']['Dimensions']['Width'] . 'm breed';
                    }
                    else
                    {
                        $garden_area = NULL;
                    }

                    $status = $property_details['RealEstateProperty']['PropertyInfo']['Status'];

                    $acceptance = $property_details['RealEstateProperty']['Offer']['Acceptance'];

                    $city = City::where('city_name', 'like', '%' . $property_details['RealEstateProperty']['Location']['Address']['CityName']['Translation'])->first();

                    if(isset($property_details['RealEstateProperty']['Dimensions']['Land']['Area']))
                    {
                        $plot_area = $property_details['RealEstateProperty']['Dimensions']['Land']['Area'];
                    }
                    else
                    {
                        $plot_area = NULL;
                    }


                    if($city)
                    {
                        $city_id = $city->id;
                    }
                    else
                    {
                        $city = new City;
                        $city->city_name = $property_details['RealEstateProperty']['Location']['Address']['CityName']['Translation'];
                        $city->status = 1;
                        $city->save();

                        $city_id = $city->id;
                    }


                    if(isset($property_details['RealEstateProperty']['Location']['FloorNumber']))
                    {
                        $floor_number = $property_details['RealEstateProperty']['Location']['FloorNumber'];
                    }
                    else
                    {
                        $floor_number = NULL;
                    }


                    if(isset($property_details['RealEstateProperty']['Gardens']['Garden']))
                    {
                        if(array_key_exists(0, $property_details['RealEstateProperty']['Gardens']['Garden']))
                        {
                            $garden_type = $property_details['RealEstateProperty']['Gardens']['Garden'][0]['Type'];
                        }
                        else
                        {
                            $garden_type = $property_details['RealEstateProperty']['Gardens']['Garden']['Type'];
                        }
                    }
                    else
                    {
                        $garden_type = NULL;
                    }


                    if(isset($property_details['RealEstateProperty']['Garages']['Garage']))
                    {
                        if(array_key_exists(0, $property_details['RealEstateProperty']['Garages']['Garage']))
                        {
                            $garage_type = $property_details['RealEstateProperty']['Garages']['Garage'][0]['Type'];
                        }
                        else
                        {
                            $garage_type = $property_details['RealEstateProperty']['Garages']['Garage']['Type'];
                        }
                    }
                    else
                    {
                        $garage_type = NULL;
                    }


                    if(isset($property_details['RealEstateProperty']['Construction']['IsNewEstate']))
                    {
                        if($property_details['RealEstateProperty']['Construction']['IsNewEstate'] == 'true')
                        {
                            $construction = 'New';
                        }
                        else
                        {
                            $construction = 'Old';
                        }
                    }
                    else
                    {
                        $construction = 'Under Construction';
                    }



                    if(isset($property_details['RealEstateProperty']['Offer']['IsForSale']))
                    {
                        if($property_details['RealEstateProperty']['Offer']['IsForSale'] == 'true')
                        {
                            $property_purpose = 'Sale';
                            $price = $property_details['RealEstateProperty']['Financials']['PurchasePrice'];
                        }
                        else
                        {
                            $property_purpose = 'Rent';
                            $price = $property_details['RealEstateProperty']['Financials']['RentPrice'];
                        }

                    }
                    else
                    {
                        $property_purpose = 'Rent';
                        $price = $property_details['RealEstateProperty']['Financials']['RentPrice'];
                    }


                    $exists = Properties::where('kolibri_realtor_id',$realtor_id)->where('kolibri_property_id',$property_id)->first();

                    if($exists)
                    {
                        if($exists->kolibri_modification != $modification)
                        {

                            $org_slug = Str::slug($property_name, "-");

                            if (Properties::where('property_slug',$org_slug)->where('id','!=',$exists->id)->exists()) {
                                $org_slug = $this->incrementSlug($org_slug);
                            }

                            $exists->property_name = $property_name;
                            $exists->property_slug = $org_slug;
                            $exists->property_type = $get_property_type->id;
                            $exists->sub_type = $get_sub_property_type->type;
                            $exists->sub_kind = $get_sub_property_kind->type;
                            $exists->city_id = $city_id;
                            $exists->property_purpose = $property_purpose;

                            if($property_purpose == 'Sale')
                            {
                                $exists->sale_price = $price;
                                $exists->rent_price = 0;
                            }
                            else
                            {
                                $exists->rent_price = $price;
                                $exists->sale_price = 0;
                            }

                            $exists->address = $address;
                            $exists->map_latitude = $address_latitude;
                            $exists->map_longitude = $address_longitude;
                            $exists->bathrooms = $bathrooms;
                            $exists->bedrooms = $bedrooms;
                            $exists->area = $area;
                            $exists->description = $description;
                            $exists->volume = $volume;
                            $exists->kolibri_realtor_id = $realtor_id;
                            $exists->kolibri_property_id = $property_id;
                            $exists->kolibri_modification = $modification;
                            $exists->construction_type = $construction;
                            $exists->year_construction = $construction_year;
                            $exists->construction_year_from = $construction_year_from;
                            $exists->construction_period = $construction_period;
                            $exists->kolibri_plot_area = $plot_area;
                            $exists->kolibri_rooms = $total_rooms;
                            $exists->floors = $floors;
                            $exists->kolibri_garden_type = $garden_type;
                            $exists->kolibri_garden_size = $garden_area;
                            $exists->kolibri_status = $status;
                            $exists->kolibri_acceptance = $acceptance;
                            $exists->garage_type = $garage_type;
                            $exists->kolibri_located_at = $floor_number;

                            $i = 0;
                            $y = 0;
                            $z = 0;
                            $docs = [];

                            foreach ($property_details['RealEstateProperty']['Attachments']['Attachment'] as $temp)
                            {
                                if($temp['Type'] == 'PHOTO' && $i<30)
                                {
                                    if($i == 0)
                                    {
                                        \File::delete(public_path() .'/upload/properties/'.$exists->featured_image.'-b.jpg');
                                        \File::delete(public_path() .'/upload/properties/'.$exists->featured_image.'-s.jpg');

                                        $filename = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                        $image = $temp['URLNormalizedFile'];

                                        $report = file_get_contents($image);

                                        file_put_contents(public_path().'/upload/properties/'.$filename.'-b.jpg', $report);
                                        file_put_contents(public_path().'/upload/properties/'.$filename.'-s.jpg', $report);

                                        $exists->featured_image = $filename;
                                    }
                                    else
                                    {
                                        $p = 'property_images'.$i;

                                        \File::delete(public_path() .'/upload/properties/'.$exists->$p.'-b.jpg');

                                        $filename = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                        $image = $temp['URLNormalizedFile'];

                                        $report = file_get_contents($image);

                                        file_put_contents(public_path().'/upload/properties/'.$filename.'-b.jpg', $report);

                                        $exists->$p = $filename;
                                    }

                                    $i++;
                                }
                                elseif($temp['Type'] == 'BROCHURE')
                                {
                                    $document = $temp['URLNormalizedFile'];

                                    $report = file_get_contents($document);

                                    $find = property_documents::where('property_id',$exists->id)->get();

                                    foreach ($find as $x)
                                    {
                                        \File::delete(public_path() .'/upload/properties/documents/'.$x->document);
                                    }

                                    property_documents::where('property_id',$exists->id)->delete();

                                    $tmpFilePath = public_path().'/upload/properties/documents/';

                                    $filename = $temp['Title']['Translation'];

                                    $ext = pathinfo(parse_url($document, PHP_URL_PATH), PATHINFO_EXTENSION);

                                    $hardPath = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                    file_put_contents($tmpFilePath . $hardPath . '.' . $ext, $report);

                                    $docs[$y] = $hardPath . "." . $ext;

                                    $y++;

                                }
                                elseif($temp['Type'] == 'VIDEO')
                                {
                                    if($z == 0)
                                    {
                                        \File::delete(public_path() .'/upload/properties/'.$exists->video);

                                        $tmpFilePath = public_path().'/upload/properties/';

                                        $hardPath = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                        $video_file_name = $temp['Title']['Translation'];

                                        $video = $temp['URLNormalizedFile'];

                                        $report = file_get_contents($video);

                                        $ext = pathinfo(parse_url($video, PHP_URL_PATH), PATHINFO_EXTENSION);

                                        file_put_contents($tmpFilePath . $hardPath . '.' . $ext, $report);

                                        $exists->video = $hardPath . '.' . $ext;

                                        $z++;
                                    }

                                }
                            }

                            $exists->save();

                            if(count($docs) > 0)
                            {
                                foreach ($docs as $key1)
                                {

                                    $property_documents = new property_documents;
                                    $property_documents->property_id = $exists->id;
                                    $property_documents->document = $key1;
                                    $property_documents->save();

                                }

                            }
                        }
                    }
                    else
                    {

                        $org_slug = Str::slug($property_name, "-");

                        if (Properties::where('property_slug',$org_slug)->exists()) {
                            $org_slug = $this->incrementSlug($org_slug);
                        }

                        $property = new Properties;
                        $property->user_id = $user_id;
                        $property->property_name = $property_name;
                        $property->property_slug = $org_slug;
                        $property->property_type = $get_property_type->id;
                        $property->sub_type = $get_sub_property_type->type;
                        $property->sub_kind = $get_sub_property_kind->type;
                        $property->city_id = $city_id;
                        $property->property_purpose = $property_purpose;

                        if($property_purpose == 'Sale')
                        {
                            $property->sale_price = $price;
                            $property->rent_price = 0;
                        }
                        else
                        {
                            $property->rent_price = $price;
                            $property->sale_price = 0;
                        }

                        $property->sale_price = $price;
                        $property->address = $address;
                        $property->map_latitude = $address_latitude;
                        $property->map_longitude = $address_longitude;
                        $property->bathrooms = $bathrooms;
                        $property->bedrooms = $bedrooms;
                        $property->area = $area;
                        $property->description = $description;
                        $property->volume = $volume;
                        $property->kolibri_realtor_id = $realtor_id;
                        $property->kolibri_property_id = $property_id;
                        $property->kolibri_modification = $modification;
                        $property->construction_type = $construction;
                        $property->construction_year_from = $construction_year_from;
                        $property->year_construction = $construction_year;
                        $property->construction_period = $construction_period;
                        $property->kolibri_plot_area = $plot_area;
                        $property->kolibri_rooms = $total_rooms;
                        $property->floors = $floors;
                        $property->kolibri_garden_type = $garden_type;
                        $property->kolibri_garden_size = $garden_area;
                        $property->kolibri_status = $status;
                        $property->kolibri_acceptance = $acceptance;
                        $property->garage_type = $garage_type;
                        $property->kolibri_located_at = $floor_number;

                        $i = 0;
                        $y = 0;
                        $z = 0;
                        $docs = [];

                        foreach ($property_details['RealEstateProperty']['Attachments']['Attachment'] as $temp)
                        {
                            if($temp['Type'] == 'PHOTO' && $i<30)
                            {
                                if($i == 0)
                                {
                                    $filename = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                    $image = $temp['URLNormalizedFile'];

                                    $report = file_get_contents($image);

                                    file_put_contents(public_path().'/upload/properties/'.$filename.'-b.jpg', $report);
                                    file_put_contents(public_path().'/upload/properties/'.$filename.'-s.jpg', $report);

                                    $property->featured_image = $filename;
                                }
                                else
                                {
                                    $p = 'property_images'.$i;

                                    $filename = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                    $image = $temp['URLNormalizedFile'];

                                    $report = file_get_contents($image);

                                    file_put_contents(public_path().'/upload/properties/'.$filename.'-b.jpg', $report);

                                    $property->$p = $filename;
                                }

                                $i++;
                            }
                            elseif($temp['Type'] == 'BROCHURE')
                            {
                                $document = $temp['URLNormalizedFile'];

                                $report = file_get_contents($document);

                                $tmpFilePath = public_path().'/upload/properties/documents/';

                                $filename = $temp['Title']['Translation'];

                                $ext = pathinfo(parse_url($document, PHP_URL_PATH), PATHINFO_EXTENSION);

                                $hardPath = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                file_put_contents($tmpFilePath . $hardPath . '.' . $ext, $report);

                                $docs[$y] = $hardPath . "." . $ext;

                            }
                            elseif($temp['Type'] == 'VIDEO')
                            {
                                if($z == 0)
                                {
                                    $tmpFilePath = public_path().'/upload/properties/';

                                    $hardPath = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                    $video_file_name = $temp['Title']['Translation'];

                                    $video = $temp['URLNormalizedFile'];

                                    $report = file_get_contents($video);

                                    $ext = pathinfo(parse_url($video, PHP_URL_PATH), PATHINFO_EXTENSION);

                                    file_put_contents($tmpFilePath . $hardPath . '.' . $ext, $report);

                                    $property->video = $hardPath . '.' . $ext;

                                    $z++;
                                }

                            }

                        }

                        $property->save();

                        if(count($docs) > 0)
                        {
                            foreach ($docs as $key1)
                            {

                                $property_documents = new property_documents;
                                $property_documents->property_id = $property->id;
                                $property_documents->document = $key1;
                                $property_documents->save();

                            }

                        }

                    }
                }
            }

        }

        \Log::info("Kolibri Cron Job is working fine!");


    }

    public function incrementSlug($slug) {

        $original = $slug;

        $count = 2;

        while (Properties::where('property_slug',$slug)->exists()) {

            $slug = "{$original}-" . $count++;
        }

        return $slug;

    }
}
