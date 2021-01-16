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
use Intervention\Image\Facades\Image;
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

    public function compressImage($source, $destination, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg')
        {
            $image = imagecreatefromjpeg($source);

            $exif = exif_read_data($source);

            if (!empty($exif['Orientation'])) {

                switch ($exif['Orientation']) {
                    case 3:
                        $image = imagerotate($image, 180, 0);
                        break;
                    case 6:
                        $image = imagerotate($image, -90, 0);
                        break;
                    case 8:
                        $image = imagerotate($image, 90, 0);
                        break;
                    default:
                        $image = $image;
                }
            }

            $img = Image::make($image);

            if($quality == 30)
            {
                if($info[0] > 1920 && $info[1] > 1080)
                {
                    $img->resize(1920, 1080, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }
            }
            elseif($quality == 25)
            {
                if($info[0] > 1280 && $info[1] > 800)
                {
                    $img->resize(1280, 800, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }
            }
            else
            {
                if($info[0] > 640 && $info[1] > 425)
                {
                    $img->resize(640, 425, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }
            }


            /*imagejpeg($image, $destination, $quality);*/
        }

        else
        {
            $img = Image::make($source);

            if($quality == 30)
            {
                if($info[0] > 1920 && $info[1] > 1080)
                {
                    $img->resize(1920, 1080, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }

            }
            elseif($quality == 25)
            {
                if($info[0] > 1280 && $info[1] > 800)
                {
                    $img->resize(1280, 800, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }
            }
            else
            {
                if($info[0] > 640 && $info[1] > 425)
                {
                    $img->resize(640, 425, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }
            }

            /*$srcImage = imagecreatefrompng($source);

            $targetImage = imagecreatetruecolor( $info[0], $info[1] );
            imagealphablending( $targetImage, false );
            imagesavealpha( $targetImage, true );

            imagecopyresampled( $targetImage, $srcImage,
                0, 0,
                0, 0,
                $info[0], $info[1],
                $info[0], $info[1] );

            $quality = 9 - ($quality/10);

            imagepng(  $targetImage, $destination, $quality );*/

        }

        return;

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
                $check->city = isset($brokers['CityName']) ? $brokers['CityName'] : null;
                $check->phone = isset($brokers['PhoneNumber']) ? $brokers['PhoneNumber'] : null;
                $check->fax = isset($brokers['FaxNumber']) ? $brokers['FaxNumber'] : null;
                $check->PostalCode = isset($brokers['PostalCode']) ? $brokers['PostalCode'] : null;
                $check->Region = isset($brokers['Region']) ? $brokers['Region'] : null;
                $check->SubRegion = isset($brokers['SubRegion']) ? $brokers['SubRegion'] : null;
                $check->CountryCode = isset($brokers['CountryCode']) ? $brokers['CountryCode'] : null;
                $check->WebAddress = isset($brokers['WebAddress']) ? $brokers['WebAddress'] : null;

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
                $user->city = isset($brokers['CityName']) ? $brokers['CityName'] : null;
                $user->PostalCode = isset($brokers['PostalCode']) ? $brokers['PostalCode'] : null;
                $user->phone = isset($brokers['PhoneNumber']) ? $brokers['PhoneNumber'] : null;
                $user->fax = isset($brokers['FaxNumber']) ? $brokers['FaxNumber'] : null;
                $user->Region = isset($brokers['Region']) ? $brokers['Region'] : null;
                $user->SubRegion = isset($brokers['SubRegion']) ? $brokers['SubRegion'] : null;
                $user->CountryCode = isset($brokers['CountryCode']) ? $brokers['CountryCode'] : null;
                $user->WebAddress = isset($brokers['WebAddress']) ? $brokers['WebAddress'] : null;
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

            if(isset($properties['ArrayOfRealEstatePropertySummarySnapshot']['RealEstatePropertySummarySnapshot']) && array_key_exists(0, $properties['ArrayOfRealEstatePropertySummarySnapshot']['RealEstatePropertySummarySnapshot']))
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


                if(is_array($property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType']))
                {
                    $property_type = $property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType'][0];
                }
                else
                {
                    $property_type = $property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType'];
                }

                if($property_type != 'PARKING')
                {
                    if(isset($property_details['RealEstateProperty']['Offer']['IsForSale']) || isset($property_details['RealEstateProperty']['Offer']['IsForRent']))
                    {

                        if(array_key_exists(0,$property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails']))
                        {
                            $property_name = $property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails'][0]['FormattedAddress'];
                        }
                        else
                        {
                            $property_name = $property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails']['AdministrativeAreaLevel2'];
                        }

                        $get_property_type = Types::where('type_en',$property_type)->first();

                        $sub_property_type = NULL;
                        $sub_property_kind = NULL;

                        if(is_array($property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType']))
                        {
                            if(isset($property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType'][1]))
                            {
                                $sub_property_type = $property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType'][1];
                                $get_sub_property_type = sub_property_types::where('type_en',$sub_property_type)->first();

                                if($get_sub_property_type)
                                {
                                    $sub_property_type = $get_sub_property_type->type;
                                }
                            }

                            if(isset($property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType'][2]))
                            {
                                $sub_property_kind = $property_details['RealEstateProperty']['Type']['PropertyTypes']['PropertyType'][2];
                                $get_sub_property_kind = sub_kinds::where('type_en',$sub_property_kind)->first();

                                if($get_sub_property_kind)
                                {
                                    $sub_property_kind = $get_sub_property_kind->type;
                                }
                            }
                        }

                        if(isset($property_details['RealEstateProperty']['Location']['Address']['CityName']['Translation']))
                        {
                            $address = $property_details['RealEstateProperty']['Location']['Address']['PostalCode'] . ' ' . $property_details['RealEstateProperty']['Location']['Address']['CityName']['Translation'];
                        }
                        else
                        {
                            $address = $property_details['RealEstateProperty']['Location']['Address']['PostalCode'] . ' ' . $property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails']['Locality'];
                        }

                        if(isset($property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails'][0]['Coordinates']['Latitude']))
                        {
                            $address_latitude = $property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails'][0]['Coordinates']['Latitude'];
                        }
                        else
                        {
                            $address_latitude = NULL;
                        }

                        if(isset($property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails'][0]['Coordinates']['Longitude']))
                        {
                            $address_longitude = $property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails'][0]['Coordinates']['Longitude'];
                        }
                        else
                        {
                            $address_longitude = NULL;
                        }

                        if(isset($property_details['RealEstateProperty']['Counts']['CountOfBathrooms']))
                        {
                            $bathrooms = $property_details['RealEstateProperty']['Counts']['CountOfBathrooms'];
                        }
                        else
                        {
                            $bathrooms = 0;
                        }

                        if(isset($property_details['RealEstateProperty']['Counts']['CountOfBedrooms']))
                        {
                            $bedrooms = $property_details['RealEstateProperty']['Counts']['CountOfBedrooms'];
                        }
                        else
                        {
                            $bedrooms = 0;
                        }

                        if(isset($property_details['RealEstateProperty']['AreaTotals']['EffectiveArea']))
                        {
                            $area = $property_details['RealEstateProperty']['AreaTotals']['EffectiveArea'];
                        }
                        else
                        {
                            $area = NULL;
                        }

                        if(isset($property_details['RealEstateProperty']['Dimensions']['Content']))
                        {
                            $volume = $property_details['RealEstateProperty']['Dimensions']['Content'];
                        }
                        else
                        {
                            $volume = NULL;
                        }


                        if(isset($property_details['RealEstateProperty']['Descriptions']['AdText']))
                        {
                            if(is_array($property_details['RealEstateProperty']['Descriptions']['AdText']['Translation']) && array_key_exists(0, $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation']))
                            {
                                if(isset($property_details['RealEstateProperty']['Descriptions']['DetailsDescription']['Translation'][0]))
                                {
                                    $description = $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation'][0] . "\n\n" . $property_details['RealEstateProperty']['Descriptions']['DetailsDescription']['Translation'][0];
                                }
                                else
                                {
                                    $description = $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation'][0];
                                }
                            }
                            else
                            {
                                if(isset($property_details['RealEstateProperty']['Descriptions']['DetailsDescription']['Translation']))
                                {
                                    if(isset($property_details['RealEstateProperty']['Descriptions']['DetailsDescription']['Translation'][0]))
                                    {
                                        $description = $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation'] . "\n\n" . $property_details['RealEstateProperty']['Descriptions']['DetailsDescription']['Translation'][0];
                                    }
                                    else
                                    {
                                        $description = $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation'] . "\n\n" . $property_details['RealEstateProperty']['Descriptions']['DetailsDescription']['Translation'];
                                    }
                                }
                                else
                                {
                                    $description = $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation'];
                                }
                            }
                        }
                        else
                        {
                            $description = null;
                        }

                        if(isset($property_details['RealEstateProperty']['Construction']['ConstructionYearFrom']))
                        {
                            $construction_year_from = $property_details['RealEstateProperty']['Construction']['ConstructionYearFrom'];
                        }
                        else
                        {
                            $construction_year_from = NULL;
                        }

                        if(isset($property_details['RealEstateProperty']['Construction']['ConstructionYearTo']))
                        {
                            $construction_year = $property_details['RealEstateProperty']['Construction']['ConstructionYearTo'];
                        }
                        else
                        {
                            $construction_year = NULL;
                        }

                        if(isset($property_details['RealEstateProperty']['Construction']['ConstructionPeriod']))
                        {
                            $construction_period = $property_details['RealEstateProperty']['Construction']['ConstructionPeriod'];
                        }
                        else
                        {
                            $construction_period = NULL;
                        }

                        if(isset($property_details['RealEstateProperty']['Counts']['CountOfRooms']))
                        {
                            $total_rooms = $property_details['RealEstateProperty']['Counts']['CountOfRooms'];
                        }
                        else
                        {
                            $total_rooms = NULL;
                        }

                        if(isset($property_details['RealEstateProperty']['Counts']['CountOfFloors']))
                        {
                            $floors = $property_details['RealEstateProperty']['Counts']['CountOfFloors'];
                        }
                        else
                        {
                            $floors = NULL;
                        }

                        if(isset($property_details['RealEstateProperty']['Gardens']['Dimensions']))
                        {
                            $garden_area = $property_details['RealEstateProperty']['Gardens']['Garden']['Dimensions']['Area'] . 'm² (' . $property_details['RealEstateProperty']['Gardens']['Garden']['Dimensions']['Length'] . 'm diep en ' . $property_details['RealEstateProperty']['Gardens']['Garden']['Dimensions']['Width'] . 'm breed';
                        }
                        else
                        {
                            $garden_area = NULL;
                        }

                        $status = $property_details['RealEstateProperty']['PropertyInfo']['Status'];

                        $acceptance = $property_details['RealEstateProperty']['Offer']['Acceptance'];

                        if(isset($property_details['RealEstateProperty']['Offer']['AvailableUntilDate']))
                        {
                            $agreement_type = 'Temporarily';
                            $agreement_until = $acceptance = $property_details['RealEstateProperty']['Offer']['AvailableUntilDate'];
                            $time = strtotime($agreement_until);
                            $agreement_until = date('d-m-Y',$time);
                        }
                        else
                        {
                            $agreement_type = 'Indefinitely';
                            $agreement_until = NULL;
                        }

                        if(isset($property_details['RealEstateProperty']['Facilities']['FurnitureType']))
                        {
                            if($property_details['RealEstateProperty']['Facilities']['FurnitureType'] == 'FURNISHED')
                            {
                                $furnished = 'Furnished';
                            }
                            else
                            {
                                $furnished = 'Unfurnished';
                            }
                        }
                        else
                        {
                            $furnished = NULL;
                        }


                        if(isset($property_details['RealEstateProperty']['Dimensions']['Land']['Area']))
                        {
                            $plot_area = $property_details['RealEstateProperty']['Dimensions']['Land']['Area'];
                        }
                        else
                        {
                            $plot_area = NULL;
                        }

                        if(isset($property_details['RealEstateProperty']['Location']['Address']['CityName']['Translation']))
                        {
                            $city_name = $property_details['RealEstateProperty']['Location']['Address']['CityName']['Translation'];
                            $city = City::where('city_name', 'like', '%' . $city_name)->first();
                        }
                        else
                        {
                            $city_name = $property_details['RealEstateProperty']['LocationDetails']['GeoAddressDetails']['Locality'];
                            $city = City::where('city_name', 'like', '%' . $city_name)->first();
                        }

                        if($city)
                        {
                            $city_id = $city->id;
                        }
                        else
                        {
                            $city = new City;
                            $city->city_name = $city_name;
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
                                if(isset($property_details['RealEstateProperty']['Garages']['Garage'][0]['Type']))
                                {
                                    $garage_type = $property_details['RealEstateProperty']['Garages']['Garage'][0]['Type'];
                                }
                                else
                                {
                                    $garage_type = null;
                                }
                            }
                            else
                            {
                                if(isset($property_details['RealEstateProperty']['Garages']['Garage']['Type']))
                                {
                                    $garage_type = $property_details['RealEstateProperty']['Garages']['Garage']['Type'];
                                }
                                else
                                {
                                    $garage_type = null;
                                }
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
                                $exists->sub_type = $sub_property_type;
                                $exists->sub_kind = $sub_property_kind;
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

                                $exists->agreement_type = $agreement_type;
                                $exists->agreement_until = $agreement_until;
                                $exists->property_furnished = $furnished;
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

                                if(isset($property_details['RealEstateProperty']['Attachments']['Attachment']))
                                {
                                    if(array_key_exists(0,$property_details['RealEstateProperty']['Attachments']['Attachment']))
                                    {
                                        $files = $property_details['RealEstateProperty']['Attachments']['Attachment'];
                                    }
                                    else
                                    {
                                        $files = array($property_details['RealEstateProperty']['Attachments']['Attachment']);
                                    }

                                    foreach ($files as $temp)
                                    {
                                        if($temp['Type'] == 'PHOTO' && $i<30)
                                        {
                                            if($i == 0)
                                            {
                                                \File::delete(public_path() .'/upload/properties/'.$exists->featured_image.'-b.jpg');
                                                \File::delete(public_path() .'/upload/properties/'.$exists->featured_image.'-s.jpg');

                                                $filename = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                                $image = $temp['URLNormalizedFile'];

                                                /*$report = file_get_contents($image);*/

                                                $this->compressImage($image,public_path().'/upload/properties/'.$filename.'-b.jpg',30);
                                                $this->compressImage($image,public_path().'/upload/properties/'.$filename.'-s.jpg',20);

                                                /*file_put_contents(public_path().'/upload/properties/'.$filename.'-b.jpg', $report);
                                                file_put_contents(public_path().'/upload/properties/'.$filename.'-s.jpg', $report);*/

                                                $exists->featured_image = $filename;
                                            }
                                            else
                                            {
                                                $p = 'property_images'.$i;

                                                \File::delete(public_path() .'/upload/properties/'.$exists->$p.'-b.jpg');

                                                $filename = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                                $image = $temp['URLNormalizedFile'];

                                                /*$report = file_get_contents($image);*/

                                                $this->compressImage($image,public_path().'/upload/properties/'.$filename.'-b.jpg',25);

                                                /*file_put_contents(public_path().'/upload/properties/'.$filename.'-b.jpg', $report);*/

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

                                            $filename = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

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

                                                $parsed = parse_url($video);

                                                if(isset($parsed['host']))
                                                {
                                                    if($parsed['host'] == 'www.youtube.com' || $parsed['host'] == 'youtube.com' || $parsed['host'] == 'youtu.be')
                                                    {
                                                        $exists->video = $video;
                                                    }
                                                }
                                                else
                                                {
                                                    $report = file_get_contents($video);

                                                    $ext = pathinfo(parse_url($video, PHP_URL_PATH), PATHINFO_EXTENSION);

                                                    file_put_contents($tmpFilePath . $hardPath . '.' . $ext, $report);

                                                    $exists->video = $hardPath . '.' . $ext;
                                                }

                                                $z++;
                                            }

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
                            $property->sub_type = $sub_property_type;
                            $property->sub_kind = $sub_property_kind;
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

                            $property->agreement_type = $agreement_type;
                            $property->agreement_until = $agreement_until;
                            $property->property_furnished = $furnished;
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

                            if(isset($property_details['RealEstateProperty']['Attachments']['Attachment']))
                            {
                                if(array_key_exists(0,$property_details['RealEstateProperty']['Attachments']['Attachment']))
                                {
                                    $files = $property_details['RealEstateProperty']['Attachments']['Attachment'];
                                }
                                else
                                {
                                    $files = array($property_details['RealEstateProperty']['Attachments']['Attachment']);
                                }

                                foreach ($files as $temp)
                                {

                                    if($temp['Type'] == 'PHOTO' && $i<30)
                                    {
                                        if($i == 0)
                                        {
                                            $filename = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                            $image = $temp['URLNormalizedFile'];

                                            /*$report = file_get_contents($image);*/

                                            $this->compressImage($image,public_path().'/upload/properties/'.$filename.'-b.jpg',30);
                                            $this->compressImage($image,public_path().'/upload/properties/'.$filename.'-s.jpg',20);

                                            /*file_put_contents(public_path().'/upload/properties/'.$filename.'-b.jpg', $report);
                                            file_put_contents(public_path().'/upload/properties/'.$filename.'-s.jpg', $report);*/

                                            $property->featured_image = $filename;
                                        }
                                        else
                                        {
                                            $p = 'property_images'.$i;

                                            $filename = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                            $image = $temp['URLNormalizedFile'];

                                            /*$report = file_get_contents($image);*/

                                            $this->compressImage($image,public_path().'/upload/properties/'.$filename.'-b.jpg',25);

                                            /*file_put_contents(public_path().'/upload/properties/'.$filename.'-b.jpg', $report);*/

                                            $property->$p = $filename;
                                        }

                                        $i++;
                                    }
                                    elseif($temp['Type'] == 'BROCHURE')
                                    {
                                        $document = $temp['URLNormalizedFile'];

                                        $report = file_get_contents($document);

                                        $tmpFilePath = public_path().'/upload/properties/documents/';

                                        $filename = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

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
                                            $tmpFilePath = public_path().'/upload/properties/';

                                            $hardPath = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                            $video = $temp['URLNormalizedFile'];

                                            $parsed = parse_url($video);

                                            if(isset($parsed['host']))
                                            {
                                                if($parsed['host'] == 'www.youtube.com' || $parsed['host'] == 'youtube.com' || $parsed['host'] == 'youtu.be')
                                                {
                                                    $property->video = $video;
                                                }
                                            }
                                            else
                                            {
                                                $report = file_get_contents($video);

                                                $ext = pathinfo(parse_url($video, PHP_URL_PATH), PATHINFO_EXTENSION);

                                                file_put_contents($tmpFilePath . $hardPath . '.' . $ext, $report);

                                                $property->video = $hardPath . '.' . $ext;
                                            }

                                            $z++;
                                        }

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
