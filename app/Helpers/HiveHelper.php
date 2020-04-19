<?php


namespace App\Helpers;


use App\Hive;
use App\Http\Requests\HiveRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HiveHelper extends Helper
{
    /**
     * Save the main and thumb image of a hive to storage
     *
     * @param HiveRequest $request
     * @param Hive|null $hive
     * @return string Image name
     */
    public static function storeHiveImages(HiveRequest $request, ?Hive $hive = null):string
    {
        $hiveImageName = uniqid();

        if(isset($hive->image)) {
            Storage::delete([
                'public/images/hives/'.$hive->image.'.jpg',
                'public/images/hives/'.$hive->image.'_thumb.jpg'
            ]);
        }

        static::storeMainImage($request, $hiveImageName);
        static::storeThumbImage($request, $hiveImageName);

        return $hiveImageName;
    }

    /**
     * Save the main hive image to storage
     *
     * @param HiveRequest $request
     * @param string $name
     * @return void
     */
    public static function storeMainImage(HiveRequest $request, string $name):void
    {
        $image = Image::make($request->file('beehive_image'))->fit(1280, 320);

        Storage::put('public/images/hives/'.$name.'.jpg', $image->encode('jpg',80));
    }

    /**
     * Save the thumb hive image to storage
     *
     * @param HiveRequest $request
     * @param string $name
     * @return void
     */
    public static function storeThumbImage(HiveRequest $request, string $name):void
    {
        $image = Image::make($request->file('beehive_image'))->fit(400, 160);

        Storage::put('public/images/hives/'.$name.'_thumb.jpg', $image->encode('jpg',80));
    }
}
