<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/bills",
     *     summary="Get a list of bills",
     *     tags={"Bills"},
     *     @OA\Response(
     *         response=200,
     *         description="List of bills",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Bill") // This should reference an existing schema
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */

    public function index()
    {
        $bills=Bill::all();
        return response($bills);
    }

    /**
     * @OA\Post(
     *     path="/api/bills",
     *     summary="Create a new bill",
     *     tags={"Bills"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Bill data",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful bill creation")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Bill created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful bill creation")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        return response([
            'message'=>'this is store method in bill controller'
        ]);
    }


    /**
     * @OA\Get(
     *     path="/api/bills/{id}",
     *     summary="Get a specific bill by ID",
     *     tags={"Bills"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the bill to retrieve",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Bill details",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Bill"))
     *     )
     * )
     */

    public function show(string $id)
    {
        return response([
            'message'=>'this is show method in bill controller to show one bill'
        ]);
    }


    /**
     * @OA\Put(
     *     path="/api/bills/{id}",
     *     summary="Update a specific bill by ID",
     *     tags={"Bills"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the bill to update",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated bill data",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful bill update")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Bill updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful bill update")
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        return response([
            'message'=>'this is update method in bill controller'
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/bills/{id}",
     *     summary="Delete a specific bill by ID",
     *     tags={"Bills"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the bill to delete",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No bill for delete"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        return response([
            'message'=>'this is destroy method in bill controller'
        ]);
    }
}