<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/plans",
     *     summary="List all plans",
     *     tags={"Plans"},
     *     @OA\Response(
     *         response=200,
     *         description="List of plans",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Plans"))
     *     )
     * )
     */
    public function index()
    {
        $plans=Plan::all();
        return response($plans);
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * @OA\Post(
     *     path="/api/plans",
     *     summary="Create a new plan",
     *     tags={"Plans"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Plan data",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful plan creation")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Plan created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful plan creation")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        return response([
            'message'=>'this is store method in plan controller'
        ]);
    }

    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     *     path="/api/plans/{id}",
     *     summary="Get a specific plan by ID",
     *     tags={"Plans"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the plan to retrieve",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="plan details",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/plan"))
     *     )
     * )
     */
    public function show(string $id)
    {
        return response([
            'message'=>'this is show method in plan controller to show one plan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * @OA\Put(
     *     path="/api/plans/{id}",
     *     summary="Update a specific plan by ID",
     *     tags={"Plans"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the plan to update",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated plan data",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful plan update")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="plan updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful plan update")
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        return response([
            'message'=>'this is update method in plan controller'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Delete(
     *     path="/api/plans/{id}",
     *     summary="Delete a specific plan by ID",
     *     tags={"Plans"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the plan to delete",
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
            'message'=>'this is delete method in plan controller'
        ]);
    }
}
