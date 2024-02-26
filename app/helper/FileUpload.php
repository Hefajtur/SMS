<?php

namespace App\helper;

class FileUpload
{
    private static $imageName, $imageDirectory, $imageUrl;
    public static function imageUpload ($image, $directory, $existUrl= null)
    {
        if ($image)
        {
            if(file_exists($existUrl))
            {
                unlink($existUrl);
            }
            self::$imageName = rand(10, 100).time().'.'.$image->extension();
            self::$imageDirectory = 'admin/assets/images/'.$directory;
            $image->move(self::$imageDirectory, self::$imageName);
            self::$imageUrl= self::$imageDirectory.self::$imageName;
        } else {
            self::$imageUrl = $existUrl;
        }
        return self::$imageUrl;
    }


}


