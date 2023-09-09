<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        try{
            $plan=Plan::all();
            if($plan){
                return response()->json([
                    'success'=>true,
                    'plan'=>$plan
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ]);
        }
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
        try{
            $validation=Validator::make($request->all(),[
                'name' => 'required|string',
                'icon' => 'required|string',
                'color' => 'required|string',
                'note' => 'nullable|string',
                'start_date' => 'required|date',
                'end_date' =>'required|date',
                'current_amount' => 'required|numeric',
                'target_amount' => 'required|numeric',
                'user_id' => 'required|exists:users,id',
                'category_id' => 'required|exists:categories,id',

            ]);
            if($validation->fails()){
                return response()->json([
                    'success'=>false,
                    'message'=>$validation->errors()->all(),
                ]);
            }else{
                $result=Plan::create($validation->validated());
                if($result){
                    return response()->json([
                        'success'=>true,
                        'message'=>"Plan Add Successfully"
                    ]);
                }else{
                    return response()->json([
                        'success'=>true,
                        'message'=>'some problem'
                    ]);
                }
            }

        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ]);
        }
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
        try{
            $plan=Plan::find($id);
            if($plan){
                return response()->json([
                    'success'=>true,
                    'plan'=>$plan
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Plan Not found'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ]);
        }
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
        try{
            $plan=Plan::findOrFail($id);
            $validation=Validator::make($request->all(),[
                'name' => 'required|string',
                'icon' => 'required|string',
                'color' => 'required|string',
                'note' => 'nullable|string',
                'start_date' => 'required|date',
                'end_date' =>'required|date',
                'current_amount' => 'required|numeric',
                'target_amount' => 'required|numeric',
                'user_id' => 'required|exists:users,id',
                'category_id' => 'required|exists:categories,id',
            ]);
            if ($validation->fails()){
                return response()->json([
                    'success'=>false,
                    'message'=>$validation->errors()->all(),
                ]);
            }else{
                $plan->update($validation->validated());
                return response()->json([
                    'success'=>true,
                    'message'=>'Plan updated successfully '
                ]);
            }

        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ]);
        }
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
        try {
            $plan=Plan::find($id);

            if($plan){
                $plan->delete();
                return response()->json([
                    'success'=>true,
                    'message'=>'Plan deleted successfully'
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'some problem'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ]);
        }
    }
}
