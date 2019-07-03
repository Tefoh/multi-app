<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return auth('api')->user();
    }

    public function update(Request $request)
    {
        $user = auth('api')->user();

        $request->validate([
            'name'      => 'required|string|max:191',
            'email'     => 'required|string|max:191|email|unique:users,email,' . $user->id,
            'type'      => 'required|string|max:191',
            'password'  => 'nullable|string|min:6',
        ]);

        $data = $request->all();

        if($request->photo != $user->photo) {

            $fileName = now()->timestamp . '.' . explode('/', substr($request->photo, 0, strpos($request->photo, ';')))[1];
            \Image::make($request->photo)->save(public_path('images/profiles/') . $fileName);

            $data['photo'] = $fileName;

            if (file_exists($userPhoto = public_path('images/profiles/') . $user->photo)) {
                unlink($userPhoto);
            }
        }

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return ['ok'];
    }
}
