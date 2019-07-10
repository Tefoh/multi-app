<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Profile extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'Profile';
    }
}