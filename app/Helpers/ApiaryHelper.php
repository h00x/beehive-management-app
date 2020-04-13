<?php


namespace App\Helpers;


use App\Http\Requests\ApiaryRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ApiaryHelper extends Helper
{
    public static function storeMainImage(ApiaryRequest $request, $name)
    {
        $image = Image::make($request->file('apiary_image'))
            ->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        Storage::put('public/images/apiaries/'.$name.'.jpg', $image->encode('jpg',80));
    }

    public static function storeThumbImage(ApiaryRequest $request, $name)
    {
        $image = Image::make($request->file('apiary_image'))
            ->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        Storage::put('public/images/apiaries/'.$name.'_thumb.jpg', $image->encode('jpg',80));
    }
}
