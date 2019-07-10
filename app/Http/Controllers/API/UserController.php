<?php

namespace App\Http\Controllers\API;

use App\User;
use Exception;
use Illuminate\Http\Response;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\Gate::allows('isAdmin')) {
            return User::latest()->paginate(15);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        try {
            $data = $request->only(['name', 'email', 'type']);
            $data['password'] = Hash::make($request->password);

            return User::create($data);
        } catch (Exception $e) {
            return \response(['an error happened!!!'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return ResponseFactory|Response
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $data = $request->only(['name', 'email', 'type']);
            if($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            $user->update($data);

            return \response(['ok'], 201);
        } catch (Exception $e) {
            return \response(['an error happened!!!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return ResponseFactory|Response
     */
    public function destroy(User $user)
    {
        try {
            $this->authorize('isAdmin');

            $user->delete();

            return \response(['ok'], 201);
        } catch (Exception $e) {
            return \response(['an error happened!!!'], 500);
        }
    }
}
