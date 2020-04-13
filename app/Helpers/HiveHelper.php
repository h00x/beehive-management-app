<?php


namespace App\Helpers;


use App\Http\Requests\HiveRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HiveHelper extends Helper
{
    public static function storeMainImage(HiveRequest $request, $name)
    {
        $image = Image::make($request->file('beehive_image'))
            ->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        Storage::put('public/images/hives/'.$name.'.jpg', $image->encode('jpg',80));
    }

    public static function storeThumbImage(HiveRequest $request, $name)
    {
        $image = Image::make($request->file('beehive_image'))
            ->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        Storage::put('public/images/hives/'.$name.'_thumb.jpg', $image->encode('jpg',80));
    }
}
