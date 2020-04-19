<?php


namespace App\Helpers;


use App\Apiary;
use App\Http\Requests\ApiaryRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ApiaryHelper extends Helper
{
    /**
     * Save the main and thumb image of an apiary to storage
     *
     * @param ApiaryRequest $request
     * @param Apiary|null $apiary
     * @return string Image name
     */
    public static function storeApiaryImages(ApiaryRequest $request, ?Apiary $apiary = null):string
    {
        $apiaryImageName = uniqid();

        if(isset($apiary->image)) {
            Storage::delete([
                'public/images/apiaries/'.$apiary->image.'.jpg',
                'public/images/apiaries/'.$apiary->image.'_thumb.jpg'
            ]);
        }

        static::storeMainImage($request, $apiaryImageName);
        static::storeThumbImage($request, $apiaryImageName);

        return $apiaryImageName;
    }

    /**
     * Save the main apiary image to storage
     *
     * @param ApiaryRequest $request
     * @param string $name
     * @return void
     */
    public static function storeMainImage(ApiaryRequest $request, string $name):void
    {
        $image = Image::make($request->file('apiary_image'))->fit(1280, 320);

        Storage::put('public/images/apiaries/'.$name.'.jpg', $image->encode('jpg',80));
    }

    /**
     * Save the thumb apiary image to storage
     *
     * @param ApiaryRequest $request
     * @param string $name
     * @return void
     */
    public static function storeThumbImage(ApiaryRequest $request, string $name):void
    {
        $image = Image::make($request->file('apiary_image'))->fit(640, 160);

        Storage::put('public/images/apiaries/'.$name.'_thumb.jpg', $image->encode('jpg',80));
    }
}
