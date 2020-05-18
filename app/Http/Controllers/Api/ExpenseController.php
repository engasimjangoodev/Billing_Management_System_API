<?php

namespace App\Http\Controllers\Api;

use App\Expense;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ExpenseResource(Expense::all());

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
            'expense_category_id' => 'required|numeric |exists:expense_categories,id',
            'amount' => 'required|numeric',
        ]);
        $input = $request->all();
        if ($request->has('date_time')) ;
        {
            $input['date_time'] = carbon::parse($request->due_date)->toDateTimeString();
        }

        $Expense= Expense::create($input);
        return new ExpenseResource($Expense);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_category_id' => 'required|numeric |exists:expense_categories,id',
            'amount' => 'required|numeric',
        ]);
        $input = $request->all();
        if ($request->has('date_time')) ;
        {
            $input['date_time'] = carbon::parse($request->due_date)->toDateTimeString();
        }

        $expense->update($input);
        return new ExpenseResource($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response(['message' => 'Deleted Successfully ']);
    }
}
