<?php

namespace App\Http\Controllers\Api;

use App\Bills;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillsResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BillsResource::collection(Bills::all()->load('user'));
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
            'user_id'=>'required|numeric',
            'amount' =>'required|numeric'
        ]);
        $input = $request->all();
        if(!User::find($request->user_id)){
            return response(["error"=>"This user_id :".$request->user_id." Is not a valid Foreign key for Users table " ],420);
        }
        if ($request->has('due_date')) ;
        {
            $input['due_date'] = carbon::parse($request->due_date)->toDateTimeString();
        }
        $user = User::find($request->user_id);
        $bill = $user->bills()->create($input);

        return new BillsResource($bill->load('user'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bills $bill)
    {
//        return BillsResource::collection(Bills::all()->load('user'));

//        return  BillsResource::collection($bills->load('user'));
//        return BillsResource::collection(Bills::find($bills)->load('user'));

        return new BillsResource($bill->load('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Bills $bill)
    {
         $request->validate([
            'user_id'=>'required|numeric',
            'amount' =>'required|numeric',
             'bill_type'=>'numeric|between:1,4'
        ]);
        $input=$request->all();
        if(!User::find($request->user_id)){
            return response(["error"=>"This user_id :".$request->user_id." Is not a valid Foreign key for Users table " ],420);
        }
        if ($request->has('due_date')) ;
        {
            $input['due_date'] = carbon::parse($request->due_date)->toDateTimeString();
        }
        $bill->update($input);
        return new BillsResource($bill->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bills $bill)
    {
        $bill->delete();
        return response(['message' => 'Deleted Successfully ']);
    }
}
