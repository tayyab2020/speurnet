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

        if(file_exists($source))
        {
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
        $properties = Properties::where('kolibri_realtor_id','!=',NULL)->get();

        foreach ($properties as $key)
        {
            $source = public_path().'/upload/properties/'.$key->featured_image.'-b.jpg';
            $this->compressImage($source,public_path().'/upload/properties/'.$key->featured_image.'-b.jpg',30);

            $source1 = public_path().'/upload/properties/'.$key->featured_image.'-s.jpg';
            $this->compressImage($source1,public_path().'/upload/properties/'.$key->featured_image.'-s.jpg',20);

            for ($i = 1; $i<=29; $i++)
            {
                $p = 'property_images'.$i;

                if($key->$p)
                {
                    $source2 = public_path().'/upload/properties/'.$key->$p.'-b.jpg';
                    $this->compressImage($source2,public_path().'/upload/properties/'.$key->$p.'-b.jpg',25);
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
