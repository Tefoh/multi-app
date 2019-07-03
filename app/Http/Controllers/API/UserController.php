<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return User::latest()->paginate(15);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:191',
            'email'     => 'required|string|max:191|unique:users,email|email',
            'type'      => 'required|string|max:191',
            'password'  => 'required|string|min:6',
        ]);
        $data = $request->only(['name', 'email', 'type']);
        $data['password'] = Hash::make($request->password);

        return User::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:191',
            'email'     => 'required|string|max:191|email|unique:users,email,' . $user->id,
            'type'      => 'required|string|max:191',
            'password'  => 'nullable|string|min:6',
        ]);

        $data = $request->only(['name', 'email', 'type']);
        if($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return ['ok'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $this->authorize('isAdmin');

        $user->delete();

        return ['ok'];
    }
}
