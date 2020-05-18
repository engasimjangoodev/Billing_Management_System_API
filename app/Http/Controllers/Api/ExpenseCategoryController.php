<?php

namespace App\Http\Controllers\Api;

use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseCategoryResource;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ExpenseCategoryResource::collection(ExpenseCategory::all());

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
            'title' => 'required',
            'description' => 'required',
        ]);

        $ExpenseCategory = ExpenseCategory::create($request->all());
        return new ExpenseCategoryResource($ExpenseCategory);

    }

    /**
     * Display the specified resource.
     *
     * @param ExpenseCategory $expenseCategory
     * @return ExpenseCategoryResource
     */
    public function show(ExpenseCategory $expensecategory)
    {
//       $data= ExpenseCategory::find($expenseCategory);
//        return new ExpenseCategoryResource($data->load(''));
//       return  ExpenseCategoryResource::collection($expenseCategory);
//        return $expenseCategory->load('expense');

//        return new ExpenseCategoryResource($expenseCategor);
        return new ExpenseCategoryResource($expensecategory);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseCategory $expensecategory)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $expensecategory->update($request->all());
        return new ExpenseCategoryResource($expensecategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expensecategory)
    {

        $expensecategory->delete();
        return response(['message' => 'Deleted Successfully ']);
    }
}
