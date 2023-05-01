<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class UploadImage
{
    /**
     * Accepts $image from a form file input
     */
    public static function upload($image, $old="")
    {
        if (File::isFile(public_path().$old)){
            File::delete(public_path().$old);
        }

        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images/profilepics'), $imageName);

        return $imageName = "/images/profilepics/".$imageName;
    }
}
