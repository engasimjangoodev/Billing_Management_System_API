<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //to get all the user
//        return TransactionResource::collection(auth()->user()->transaction()->latest()->get());

        //with pagination
//        return TransactionResource::collection(auth()->user()->transaction()->latest()->paginate(4));

        //with user data all the payment pagination
        return TransactionResource::collection(Transaction::all()->load('creator'));
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'amount' => 'required|numeric',
            'user_id'=>'required|int',
        ]);
        $input=$request->all();
        if (!User::find($request->user_id)){
           return response(["error"=>"This user_id :".$request->user_id." Is not a valid Foreign key for Users table " ]);
        }

        if ($request->has('due_date')) ;
        {
            $input['due_date'] = carbon::parse($request->due_date)->toDateTimeString();
        }
        $user = User::find($request->user_id);
        $transaction = $user->transaction()->create($input);
        return new TransactionResource($transaction->load('creator'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction->load('creator'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'title' => 'required|max:255',
            'amount' => 'required|int',
            'user_id'=>'required|int',

        ]);
        $input=$request->all();
        if (!User::find($request->user_id)){
            return response(["error"=>"This user_id :".$request->user_id." Is not a valid Foreign key for Users table " ]);
        }
        if ($request->has('due_date')) ;
        {
            $input['due_date'] = carbon::parse($request->due_date)->toDateTimeString();
        }

        $transaction->update($input);
        return new TransactionResource($transaction->load('creator'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response(['message' => 'Deleted Successfully ']);
    }
}
