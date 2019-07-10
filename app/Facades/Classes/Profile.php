<?php


namespace App\Facades\Classes;


class Profile
{

    public function store()
    {
        return 'hi';
    }


    public function update()
    {
        if(request()->photo != auth('api')->user()->photo) {
            $fileName = now()->timestamp . '.' . explode('/', substr(request()->photo,
                    0,
                    strpos(request()->photo, ';')))[1];

            \Image::make(request()->photo)->save(public_path('images/profiles/') . $fileName);

            if (file_exists($userPhoto = public_path('images/profiles/') . auth('api')->user()->photo)) {
                unlink($userPhoto);
            }

            return $fileName;
        }
    }
}