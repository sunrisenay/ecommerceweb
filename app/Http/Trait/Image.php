<?php

namespace App\Http\Trait;

use Illuminate\Support\Facades\File;

trait Image{
    public function upload($file){
        $file_name = uniqid().$file->getClientOriginalName();
        $file->move(public_path('../public/assets/img/'),$file_name);
        return $file_name;
    }

    public function delete($image_name)
    {
        File::delete(public_path('../public/assets/img/'.$image_name));
        return true;
    }
}
