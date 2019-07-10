<?php

namespace App\Http\Controllers\API;

use App\Facades\Profile;
use App\Http\Requests\ProfileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function index()
    {
        return auth('api')->user();
    }

    public function update(ProfileRequest $request)
    {
        try {
            $user = auth('api')->user();

            $data = $request->all();
            $data['photo'] = Profile::update();

            if (! empty($request->password)) {
                $data['password'] = Hash::make($request->password);
            }
            $user->update($data);

            return response()->json(['updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['an error happened!!!'], 500);
        }
    }
}
