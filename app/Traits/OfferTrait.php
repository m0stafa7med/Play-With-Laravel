<?php

namespace App\Traits;


trait offerTrait
{
   
     function saveImage($photo,$folder)
    {
        $file_extension=$photo->photo->getClientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $path=$folder;
        $photo->photo->move($path,$file_name);

        return $file_name;
    }
   
}
