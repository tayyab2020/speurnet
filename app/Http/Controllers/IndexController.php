<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\cookies;
use App\Expats;
use App\footer_pages;
use App\HomepageIcons;
use App\moving_tips;
use App\moving_tips_contents;
use App\property_documents;
use App\savedPropertyAlert;
use App\Settings;
use App\sub_kinds;
use App\sub_property_types;
use App\Types;
use App\user_languages;
use Auth;
use App\User;
use App\City;
use App\Properties;
use App\Testimonials;
use App\Subscriber;
use App\Partners;

use Intervention\Image\Facades\Image;
use Mail;
use Crypt;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class IndexController extends Controller
{

    public function kolibri()
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
                    curl_setopt($ch, CURLOPT_URL, 'https://api.wazzupsoftware.com/OutputService.svc/16/0/b37f7923-b6ZO-46JE-93HU-3442c7c81e76/realestate/?realtorid='.$realtor_id.'&id=3664426');
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

                        $bedrooms = $property_details['RealEstateProperty']['Counts']['CountOfBedrooms'];

                        $area = $property_details['RealEstateProperty']['AreaTotals']['EffectiveArea'];

                        $volume = $property_details['RealEstateProperty']['Dimensions']['Content'];

                        $description = $property_details['RealEstateProperty']['Descriptions']['AdText']['Translation'] . "\n\n" . $property_details['RealEstateProperty']['Descriptions']['DetailsDescription']['Translation'];

                        $construction_year_from = $property_details['RealEstateProperty']['Construction']['ConstructionYearFrom'];

                        $construction_year = $property_details['RealEstateProperty']['Construction']['ConstructionYearTo'];

                        $construction_period = $property_details['RealEstateProperty']['Construction']['ConstructionPeriod'];

                        $total_rooms = $property_details['RealEstateProperty']['Counts']['CountOfRooms'];

                        $floors = $property_details['RealEstateProperty']['Counts']['CountOfFloors'];

                        $garden_area = $property_details['RealEstateProperty']['Gardens']['Garden']['Dimensions']['Area'] . 'm² (' . $property_details['RealEstateProperty']['Gardens']['Garden']['Dimensions']['Length'] . 'm diep en ' . $property_details['RealEstateProperty']['Gardens']['Garden']['Dimensions']['Width'] . 'm breed';

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

                                        $ext = pathinfo($filename, PATHINFO_EXTENSION);

                                        $hardPath = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                        file_put_contents($tmpFilePath . $hardPath . '.' . $ext, $report);

                                        $docs[$y] = $hardPath . "." . $ext;

                                        $y++;

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

                                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                                    $hardPath = Str::slug($property_name, '-').'-'.md5(rand(0,99999));

                                    file_put_contents($tmpFilePath . $hardPath . '.' . $ext, $report);

                                    $docs[$y] = $hardPath . "." . $ext;

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
    }

    public function incrementSlug($slug) {

        $original = $slug;

        $count = 2;

        while (Properties::where('property_slug',$slug)->exists()) {

            $slug = "{$original}-" . $count++;
        }

        return $slug;

    }

    public function test()
    {
        return view('test');
    }

    public function testUpload(Request $request)
    {

        $property_images = $request->file('property_images');


        if($property_images){

            $countfiles = count($_FILES['property_images']['name']);

            $tmpFilePath = 'upload/test/';

            for($i=0;$i<$countfiles;$i++) {

                $filename = $_FILES['property_images']['name'][$i];

                if($filename)
                {

                    $hardPath =  Str::slug("Test Image", '-').'-'.md5(rand(0,99999));

                    $target_file = $tmpFilePath . $hardPath . '-b.jpg';

                    $image = $_FILES['property_images']['tmp_name'][$i];

                    $resize_image = Image::make($image);

                    $resize_image->resize(1280, 800, function($constraint){
                        $constraint->aspectRatio();
                    })->save($target_file);


                }

            }

        }

        echo "Images uploaded successfully!";
    }

    public function redirect($service) {
        return Socialite::driver ( $service )->stateless()->redirect();
    }

    public function callback($service) {

        $user = Socialite::with ( $service )->stateless()->user();

        if(!$user->email)
        {

            return redirect('/')->withErrors(__('text.Please link your facebook account with an email address.'));

        }

        $user = $this->createUser($user,$service);

        auth()->login($user);

        return redirect('admin/confirm-user-type');

    }

    public function changeLanguage(Request $request)
    {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }

        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        //whether ip is from remote address
        else
        {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        $lang = user_languages::where('ip','=',$ip_address)->update(['lang' => $request->language]);

        \App::setLocale($request->language);

        return redirect()->back();
    }

    public function createUser($getInfo,$provider){

        $user = User::where('provider_id', $getInfo->id)->orWhere('email',$getInfo->email)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'usertype' => '',
                'password' => bcrypt(Str::random(10)),
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'status' => 1
            ]);

            $user_name = $getInfo->name;
            $user_email = $getInfo->email;

            Mail::send('emails.social_register_confirm',
                array(
                    'name' => $user_name,
                ), function($message) use ($user_name,$user_email)
                {
                    $message->from(getcong('site_email'),getcong('site_name'));
                    $message->to($user_email,$user_name)->subject(__('text.Registration Confirmation'));
                });
        }
        return $user;

    }

    public function unsubscribeAlert($id)
    {
        $id = Crypt::decrypt($id);

        $post = savedPropertyAlert::where('id',$id)->delete();

        return redirect('/')->with('flash_message', 'Property Alert Unsubscribed Successfully.');;

    }

    public function savepropertyalert(Request $request)
    {

        if($request->search_type == "standard")
        {
            $existingProperties=savedPropertyAlert::where('user_email',$request->email)
                ->where('radius',$request->radius)
                ->where('address',$request->address)->where('longitude',$request->longitude)->where('latitude',$request->latitude)
                ->where('property_type',$request->property_type)
                ->where('type',$request->type)
                ->where('property_purpose',$request->property_purpose)
                ->where('bedrooms',$request->bedrooms)
                ->where('bathrooms',$request->bathrooms)
                ->where('max_price',$request->max_price)->where('min_price',$request->min_price)
                ->where('max_area',$request->max_area)->where('min_area',$request->min_area)
                ->where('type_of_construction',$request->type_of_construction)
                ->where('keywords',$request->keywords)
                ->where('wheelchair',$request->wheelchair)
                ->where('search_type',1)
                ->first();
            if($existingProperties){
                return redirect('/')->with('flash_message', 'Your have already created Property Alert for this Search');
            }
            else{
                $property = new savedPropertyAlert;
                $property->user_email = $request->email;
                $property->radius = $request->radius;
                $property->property_type = $request->property_type;
                $property->type = $request->type;
                $property->bedrooms = $request->bedrooms;
                $property->bathrooms = $request->bathrooms;
                $property->address = $request->address;
                $property->longitude = $request->longitude;
                $property->latitude = $request->latitude;
                $property->property_purpose = $request->property_purpose;
                $property->max_price = $request->max_price;
                $property->min_price = $request->min_price;
                $property->max_area = $request->max_area;
                $property->min_area = $request->min_area;
                $property->type_of_construction = $request->type_of_construction;
                $property->keywords = $request->keywords;
                $property->wheelchair = $request->wheelchair;
                $property->search_type = 1;
                $property->save();
                return redirect('/')->with('flash_message', __('text.Property Alert Created Successfully, You will now receive Emails for Similar Properties'));
            }
        }
        else
        {
            $existingProperties=savedPropertyAlert::where('user_email',$request->email)
                ->where('radius',$request->radius)
                ->where('address',$request->address)->where('longitude',$request->longitude)->where('latitude',$request->latitude)
                ->where('property_type',$request->property_type)
                ->where('type',$request->type)
                ->where('bedrooms',$request->bedrooms)
                ->where('bathrooms',$request->bathrooms)
                ->where('max_price',$request->max_price)->where('min_price',$request->min_price)
                ->where('max_area',$request->max_area)->where('min_area',$request->min_area)
                ->where('kind_of_type',$request->kind_of_type)
                ->where('keywords',$request->keywords)
                ->where('wheelchair',$request->wheelchair)
                ->where('search_type',2)
                ->first();
            if($existingProperties){
                return redirect('/')->with('flash_message', 'Your have already created Property Alert for this Search');
            }
            else{
                $property = new savedPropertyAlert;
                $property->user_email = $request->email;
                $property->radius = $request->radius;
                $property->property_type = $request->property_type;
                $property->type = $request->type;
                $property->bedrooms = $request->bedrooms;
                $property->bathrooms = $request->bathrooms;
                $property->address = $request->address;
                $property->longitude = $request->longitude;
                $property->latitude = $request->latitude;
                $property->max_price = $request->max_price;
                $property->min_price = $request->min_price;
                $property->max_area = $request->max_area;
                $property->min_area = $request->min_area;
                $property->kind_of_type = $request->kind_of_type;
                $property->keywords = $request->keywords;
                $property->wheelchair = $request->wheelchair;
                $property->search_type = 2;
                $property->save();
                return redirect('/')->with('flash_message', __('text.Property Alert Created Successfully, You will now receive Emails for Similar Properties'));
            }
        }

    }

    public function index()
    {

    	if(!$this->alreadyInstalled()) {
            return redirect('install');
        }

    	$city_list = City::where('status','1')->orderBy('city_name')->get();

		$propertieslist = Properties::leftjoin('users','users.id','=','properties.user_id')->where('properties.status','1')->orderBy('properties.id', 'desc')->select('properties.*','users.company_name','users.image_icon','users.id as user_id','users.landlord')->get();

		/*$testimonials = Testimonials::orderBy('id', 'desc')->get();*/

		$partners = Partners::orderBy('id', 'desc')->get();

        $blogs = Blogs::orderBy('id', 'desc')->get();

		$top_members = User::withCount('properties')->where('users.usertype','=','Agents')->where('users.status',1)->where('users.landlord','!=',1)->having('properties_count', '>', 0)->orderBy('properties_count', 'desc')->get();

		$top_properties = Properties::orderBy('views', 'desc')->get();

		$content = HomepageIcons::orderBy('id','asc')->get();

		$most_viewed = Properties::orderBy('views','desc')->first();

		$heading = Settings::where('id',1)->first();

        date_default_timezone_set("Europe/Amsterdam");

        $i = 0;

        foreach($propertieslist as $key)
        {

            $time_ago        = strtotime($key->created_at);
            $current_time    = time();
            $time_difference = $current_time - $time_ago;
            $seconds         = $time_difference;

            $minutes = round($seconds / 60); // value 60 is seconds
            $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
            $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
            $weeks   = round($seconds / 604800); // 7*24*60*60;
            $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
            $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60


            if ($seconds <= 60){

                $listed = __('text.Listed just now');

            } else if ($minutes <= 60){

                if ($minutes == 1){

                    $listed = __('text.Listed one minute ago');

                } else {

                    $listed = __('text.Listed minutes ago',['minutes' => $minutes]);

                }

            } else if ($hours <= 24){

                if ($hours == 1){

                    $listed = __('text.Listed an hour ago');

                } else {

                    $listed = __('text.Listed hrs ago',['hours' => $hours]);

                }

            } else if ($days <= 7){

                if ($days == 1){

                    $listed = __('text.Listed yesterday');

                } else {

                    $listed = __('text.Listed days ago',['days' => $days]);

                }

            } else if ($weeks <= 4.3){

                if ($weeks == 1){

                    $listed = __('text.Listed this week');

                } else {

                    $listed = __('text.Listed this month');

                }

            }
            else
            {
                $listed = '';
            }



            $propertieslist[$i]->listed = $listed;

            $i = $i + 1;

        }

        $cookie = cookies::where('ip',\Request::ip())->first();

        return view('pages.index',compact('cookie','propertieslist','blogs', 'heading', 'most_viewed', 'partners','city_list','top_members','top_properties','content'));
    }

    public function Blogs()
    {
        $blogs = Blogs::orderBy('id', 'desc')->paginate(9);

        return view('pages.blogs',compact('blogs'));
    }

    public function Blog($id)
    {
        $blog = Blogs::where('id',$id)->first();

        return view('pages.blog',compact('blog'));
    }

    public function FooterPage($id)
    {
        $blog = footer_pages::where('id',$id)->first();

        return view('pages.blog',compact('blog'));
    }

    public function MovingTips()
    {
        $m_e = moving_tips::orderBy('id', 'desc')->get();

        $content = moving_tips_contents::orderBy('id','asc')->get();

        $heading = Settings::where('id',1)->first();

        return view('pages.m_e_page',compact('m_e','content','heading'));
    }

    public function MovingTip($id)
    {
        $blog = moving_tips::where('id',$id)->first();

        return view('pages.blog',compact('blog'));
    }

    public function Expats()
    {
        $m_e = Expats::orderBy('id', 'desc')->paginate(9);

        return view('pages.m_e_page',compact('m_e'));
    }

    public function Expat($id)
    {
        $blog = Expats::where('id',$id)->first();

        return view('pages.blog',compact('blog'));
    }

    public function subscribe(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'email' => 'required|email|max:75'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                echo '<p style="color: #db2424;font-size: 20px;">' . __('text.The email field is required.') . '</p>';
                exit;
        }

    	$subscriber = new Subscriber;

    	$subscriber->email = $inputs['email'];
    	$subscriber->ip = $_SERVER['REMOTE_ADDR'];


	    $subscriber->save();

	    echo '<p style="color: #189e26;font-size: 20px;">' . __("text.Successfully subscribe") . '</p>';
        exit;

    }

    public function cookieSave(Request $request)
    {

        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $cookie = new cookies;

        $cookie->ip = $inputs['ip'];
        $cookie->choice = $inputs['choice'];

        $cookie->save();

        return "Done";

    }

	/**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }


	public function aboutus_page()
    {
        return view('pages.about');
    }

    public function careers_with_page()
    {
        return view('pages.careers');
    }

    public function terms_conditions_page()
    {
        return view('pages.terms_conditions');
    }

    public function privacy_policy_page()
    {
        return view('pages.privacy');
    }

    public function contact_us_page()
    {
        return view('pages.contact');
    }

    public function contact_us_sendemail(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'name' => 'required',
				'email' => 'required|email',
		        'user_message' => 'required'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }



        Mail::send('emails.contact',
        array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'user_message' => $inputs['user_message']
        ), function($message)
	    {
	        $message->from(getcong('site_email'));
	        $message->to(getcong('site_email'), getcong('site_name'))->subject(getcong('site_name').' Contact');
	    });



 		 return redirect()->back()->with('flash_message', 'Thanks for contacting us!');
    }


    /**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login()
    {
    	if (Auth::check()) {

            return redirect('admin/dashboard');
        }

        return view('pages.login');
    }


    public function postLogin(Request $request)
    {


    //echo bcrypt('123456');
    //exit;

      $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');


        $user = User::where('email', $request->email)->first();


        if($user)
        {
            if($user->provider_id != NULL)
            {

                return redirect('/login')->withErrors(__('text.This Email ID is linked with Social Login. Use Social Login buttons to login.'));

            }

            if (Auth::attempt($credentials, $request->has('remember'))) {

                if(Auth::user()->status=='0'){
                    \Auth::logout();
                    return redirect('/login')->withErrors(__('text.Your account is not activated yet, please check your email.'));
                }


                return $this->handleUserWasAuthenticated($request);
            }
        }

       // return array("errors" => 'The email or the password is invalid. Please try again.');
        //return redirect('/admin');
       return redirect('/login')->withErrors(__('text.The email or the password is invalid. Please try again.'));

    }

     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect('/');
    }

    public function register()
    {
    	if (Auth::check()) {

            return redirect('admin/dashboard');
        }

        return view('pages.register');
    }

    public function postRegister(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'name' => 'required',
		        'email' => 'required|email|max:75|unique:users',
		        'password' => 'required|min:3|confirmed'
		   		 );

        $messages = [
            'name.required' => __('text.Name is required.'),
            'email.unique' => __('text.Email is already been taken.'),
            'email.required' => __('text.The email field is required.'),
            'email.max' => 'Email should not be greater than 75 characters',
            'email.email' => 'Invalid Email',
            'password.required' => __('text.Password is required'),
            'password.min' => __('text.Password should be greater than 3 characters'),
            'password.confirmed' => __('text.Password & Confirm Password does not match')
        ];

	   	 $validator = \Validator::make($data,$rule,$messages);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }


        $user = new User;

		$string = Str::random(15);
		$user_name= $request->name;
		$user_email= $request->email;

		if($request->usertype == "landlord")
        {
           $user->usertype = "Agents";
            $user->landlord = 1;
        }
		else
        {
            $user->usertype = $request->usertype;
        }

		$user->name = $user_name;
		$user->company_name = $request->company_name;
		$user->email = $user_email;
		$user->password= bcrypt($request->password);
		$user->phone= $request->phone;
		$user->city= $request->city;

		$user->confirmation_code= $string;

	    $user->save();

		Mail::send('emails.register_confirm',
        array(
            'name' => $user_name,
            'email' => $user_email,
            'password' => $request->password,
            'confirmation_code' => $string,
            'user_message' => 'test',
            'user_type' => $request->usertype,
        ), function($message) use ($user_name,$user_email)
	    {
	        $message->from(getcong('site_email'),getcong('site_name'));
            $message->to($user_email,$user_name)->subject(__('text.Registration Confirmation'));
	    });



            \Session::flash('flash_message', __('text.Please verify your account. We\'ll send a verification link to the email address.'));

            return \Redirect::back();


    }


    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        //return redirect('admin/');
        return redirect('/');
    }

    public function confirm($code)
    {

        $user = User::where('confirmation_code',$code)->first();

 		$user->status = '1';

 		$user->save();

 		\Session::flash('flash_message', __('text.Confirmation successful...'));

        return view('pages.login');
    }

}
