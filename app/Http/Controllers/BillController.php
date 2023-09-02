<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response([
            'message'=>'this is store method in bill controller'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $bills=Bill::all();
        return response($bills);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response([
            'message'=>'this is update method in bill controller'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response([
            'message'=>'this is destroy method in bill controller'
        ]);
    }
}
