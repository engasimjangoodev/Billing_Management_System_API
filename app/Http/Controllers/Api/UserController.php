<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Rules\CNIC;
use App\Rules\MobileNumber;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all()->load('details')->load('transaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if check then add to accrss token
        // add typye of user 1-2-3 (1 for admin)
        //save password as phone
        // genrate access token for login
//return UserDetails::all()->load('user');

        $request->validate([
            'name' => 'required|max:55',
            'address' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
            'User_type' => 'int',
            'phone' => ['required', new MobileNumber],//   0345-1234567   or 03451234567
            'cnic' => ['required', new CNIC],    //35202-7788145-8 and 352027788145-8 and 35202-77881458
        ]);
        $input=$request->all();
        $input['password'] = bcrypt($request->password);
        if (!$request->has('User_type')) {
            $input['User_type'] = 1;
        }
        $user = User::create($input);
        $user->details()->create($input);
        return new UserResource($user->load('details'), $user->load('transaction'));


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return new UserResource($user->load('details')->load('transaction'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:55',
            'address' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
            'User_type' => 'required|numeric '

        ]);
        $input=$request->all();
        $input['password'] = bcrypt($request->password);

        $user->update($input);
        $user->details($input);
        return new UserResource($user->load('details')->load('transaction'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response(['message' => 'Deleted Successfully ']);
    }
}
