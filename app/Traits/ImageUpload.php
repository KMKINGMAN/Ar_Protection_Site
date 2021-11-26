<?php

namespace App\Traits;


use Illuminate\Support\Str;

Trait ImageUpload
{
    function uploadImage($image, $directory): string
    {
        // making a name to the image
        $file_extension = $image->getClientOriginalExtension();
        $file_name = Str::random(20) . '.' . $file_extension;

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        // saving image
        $image->move($directory, $file_name);
        return  $directory . '/'. $file_name;
    }

}
