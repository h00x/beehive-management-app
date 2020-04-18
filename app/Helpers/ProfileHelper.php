<?php


namespace App\Helpers;


use App\Http\Requests\ProfileRequest;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileHelper extends Helper
{
    /**
     * Saves the profile image in storage and returns the name of the image
     *
     * @param ProfileRequest $request
     * @param $user
     * @return string Returns the name of the image saved in public/images/profiles/
     */
    public static function storeProfileImage(ProfileRequest $request, $user):string
    {
        $name = uniqid();

        if (isset($user->profile_image_name)) {
            Storage::delete('public/images/profiles/'.$user->profile_image_name.'.jpg');
        }

        $image = Image::make($request->file('profile_image'))->fit(256, 256);

        Storage::put('public/images/profiles/'.$name.'.jpg', $image->encode('jpg',80));

        return $name;
    }
}
