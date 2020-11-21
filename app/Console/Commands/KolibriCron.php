<?php

namespace App\Console\Commands;

use App\New_Constructions;
use App\Properties;
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

        foreach($arr['ArrayOfMediaContractSnapshot'] as $k=> $brokers) {

            $check = User::where('email',$brokers['EmailAddress'])->first();

            if($check)
            {
                $check->RealtorID = $brokers['RealtorID'];
                $check->MediaContractID = $brokers['MediaContractID'];
                $check->name = $brokers['Name'];
                $check->address = $brokers['AddressLine1'];
                $check->city = $brokers['CityName'];
                $check->phone = $brokers['PhoneNumber'];
                $check->fax = $brokers['FaxNumber'];
                $check->PostalCode = $brokers['PostalCode'];
                $check->Region = $brokers['Region'];
                $check->SubRegion = $brokers['SubRegion'];
                $check->CountryCode = $brokers['CountryCode'];
                $check->WebAddress = $brokers['WebAddress'];
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
                $user->fax = $brokers['FaxNumber'];
                $user->Region = $brokers['Region'];
                $user->SubRegion = $brokers['SubRegion'];
                $user->CountryCode = $brokers['CountryCode'];
                $user->WebAddress = $brokers['WebAddress'];
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
                        $message->to($user_email,$user_name)->subject('Account Confirmation');
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

            foreach ($properties['ArrayOfRealEstatePropertySummarySnapshot'] as $property)
            {

                foreach ($property as $key)
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
                    curl_setopt($ch, CURLOPT_URL, 'https://api.wazzupsoftware.com/OutputService.svc/16/0/b37f7923-b6ZO-46JE-93HU-3442c7c81e76/realestate/?realtorid='.$brokers['RealtorID'].'&id='.$property_id);
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

                        $org_slug = Str::slug($property_name, "-");

                        if (Properties::where('property_slug',$org_slug)->exists()) {
                            $org_slug = $this->incrementSlug($org_slug);
                        }

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

                        $bedrooms = $property_details['RealEstateProperty']['Counts']['CountOfBedrooms'];

                        $garage = isset($property_details['RealEstateProperty']['Facilities']['Garage']);

                        $area = $property_details['RealEstateProperty']['AreaTotals']['EffectiveArea'];

                        $volume = $property_details['RealEstateProperty']['Dimensions']['Content'];

                        $description = $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation'] . "\n\n" . $property_details['RealEstateProperty']['Descriptions']['DetailsDescription']['Translation'];

                        if($garage)
                        {
                            if($property_details['RealEstateProperty']['Facilities']['Garage']['Available'])
                            {
                                $garage = 1;
                            }
                            else
                            {
                                $garage = 0;
                            }
                        }
                        else
                        {
                            $garage = 0;
                        }

                        if(isset($property_details['RealEstateProperty']['Offer']['IsForSale']))
                        {
                            $property_purpose = 'Sale';
                            $price = $property_details['RealEstateProperty']['Financials']['PurchasePrice'];
                        }
                        else
                        {
                            $property_purpose = 'Rent';
                            $price = $property_details['RealEstateProperty']['Financials']['RentPrice'];
                        }

                        $exists = Properties::where('kolibri_realtor_id',$realtor_id)->where('kolibri_property_id',$property_id)->first();

                        if($exists)
                        {
                            if(strcmp($exists->kolibri_modification,$modification) < 0)
                            {
                                $exists->property_name = $property_name;
                                $exists->property_slug = $org_slug;
                                $exists->property_type = $get_property_type->id;
                                $exists->sub_type = $get_sub_property_type->type;
                                $exists->sub_kind = $get_sub_property_kind->type;
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
                                $exists->garage = $garage;
                                $exists->area = $area;
                                $exists->description = $description;
                                $exists->volume = $volume;
                                $exists->kolibri_realtor_id = $realtor_id;
                                $exists->kolibri_property_id = $property_id;
                                $exists->kolibri_modification = $modification;

                                foreach ($property_details['RealEstateProperty']['Attachments']['Attachment'] as $i => $temp)
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
                                    }
                                }

                                $exists->save();
                            }
                        }
                        else
                        {

                            $property = new Properties;
                            $property->user_id = $user_id;
                            $property->property_name = $property_name;
                            $property->property_slug = $org_slug;
                            $property->property_type = $get_property_type->id;
                            $property->sub_type = $get_sub_property_type->type;
                            $property->sub_kind = $get_sub_property_kind->type;
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
                            $property->garage = $garage;
                            $property->area = $area;
                            $property->description = $description;
                            $property->volume = $volume;
                            $property->kolibri_realtor_id = $realtor_id;
                            $property->kolibri_property_id = $property_id;
                            $property->kolibri_modification = $modification;

                            foreach ($property_details['RealEstateProperty']['Attachments']['Attachment'] as $i => $temp)
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
                                }
                            }

                            $property->save();

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
