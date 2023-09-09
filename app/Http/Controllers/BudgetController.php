<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        try{
           $budgets=Budget::all();
            if($budgets){
                return response()->json([
                    'success'=>true,
                    'category'=>$budgets
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
        try{
            $validation=Validator::make($request->all(),[
                'name'=>'required|string|max:100|unique:budgets',
                'user_id'=>'required|exists:users,id',
                'amount'=>'required|numeric',
                'category_id'=>'required|exists:categories,id',
                'start_date'=>'required|date',
                'end_date'=>'required|date',
                'period'=>'required|date',

            ]);
            if($validation->fails()){
                return response()->json([
                    'success'=>false,
                    'message'=>$validation->errors()->all(),
                ]);
            }else{
                $result=Budget::create($validation->validated());
                if($result){
                    return response()->json([
                        'success'=>true,
                        'message'=>"Budget Add Successfully"
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
    public function show(string $id)
    {
        try{
            $budget=Budget::find($id);
            if($budget){
                return response()->json([
                    'success'=>true,
                    'category'=>$budget
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Budget Not found'
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
        try{
            $budget=Budget::findOrFail($id);
            $validation=Validator::make($request->all(),[
                'name'=>'required|string|max:100|unique:budgets',
                'user_id'=>'required|exists:users,id',
                'amount'=>'required|numeric',
                'category_id'=>'required|exists:categories,id',
                'start_date'=>'required|date',
                'end_date'=>'required|date',
                'period'=>'required|date',
            ]);
            if ($validation->fails()){
                return response()->json([
                    'success'=>false,
                    'message'=>$validation->errors()->all(),
                ]);
            }else{
                $budget->update($validation->validated());
                return response()->json([
                    'success'=>true,
                    'message'=>'Budget updated successfully '
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
        try {
            $budget=Budget::find($id);

            if($budget){
               $budget->delete();
                return response()->json([
                    'success'=>true,
                    'message'=>'Budget deleted successfully'
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
