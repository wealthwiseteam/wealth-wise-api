<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use Illuminate\Http\Request;
/**
 * @OA\Tag(
 *     name="Budgets",
 *     description="Endpoints for managing budgets"
 * )
 */
class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/budgets",
     *     summary="List all budgets",
     *     tags={"Budgets"},
     *     @OA\Response(
     *         response=200,
     *         description="List of budgets",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Budget"))
     *     )
     * )
     */
    public function index()
    {
        $budgets=Budget::all();
        return response($budgets);
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * @OA\Post(
     *     path="/api/budgets",
     *     summary="Create a new budget",
     *     tags={"Budgets"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Budget data",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful budget creation")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Budget created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful budget creation")
     *         )
     *     )
     * )
     */


    public function store(Request $request)
    {
        return response([
            'message'=>'this is store method in budget controller'
        ]);
    }

    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     *     path="/api/budgets/{id}",
     *     summary="Get a specific budget by ID",
     *     tags={"Budgets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the budget to retrieve",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Budget details",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Budget"))
     *     )
     * )
     */
    public function show()
    {
        return response([
            'message'=>'this is show method in bill controller to show one bill'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * @OA\Put(
     *     path="/api/budgets/{id}",
     *     summary="Update a specific budget by ID",
     *     tags={"Budgets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the budget to update",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated budget data",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful budget update")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Budget updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful budget update")
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        return response([
            'message'=>'this is update method in budget controller'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Delete(
     *     path="/api/budgets/{id}",
     *     summary="Delete a specific budget by ID",
     *     tags={"Budgets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the budget to delete",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No content"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        return response([
            'message'=>'this is delete method in budget controller'
        ]);
    }
}
