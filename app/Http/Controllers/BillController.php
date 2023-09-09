<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        try{
            $bills=Bill::all();
            if($bills){
                return response()->json([
                    'success'=>true,
                    'category'=>$bills
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
        try{
            $validation=Validator::make($request->all(),[
                'name'=>'required|string|max:100|unique:bills',
                'user_id'=>'required|exists:users,id',
                'amount'=>'required|numeric',
                'category_id'=>'required|exists:categories,id',
                'payment_date'=>'required|date',
                'status'=>'required|boolean',
                'period'=>'required|date',

            ]);
            if($validation->fails()){
                return response()->json([
                    'success'=>false,
                    'message'=>$validation->errors()->all(),
                ]);
            }else{
                $result=Bill::create($validation->validated());
                if($result){
                    return response()->json([
                        'success'=>true,
                        'message'=>"Bill Add Successfully"
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
        try{
            $bill=Bill::find($id);
            if($bill){
                return response()->json([
                    'success'=>true,
                    'bill'=>$bill
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Bill Not found'
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
        try{
            $bill=Bill::findOrFail($id);
            $validation=Validator::make($request->all(),[
                'name'=>'required|string|max:100|unique:bills',
                'user_id'=>'required|exists:users,id',
                'amount'=>'required|numeric',
                'category_id'=>'required|exists:categories,id',
                'payment_date'=>'required|date',
                'status'=>'required|boolean',
                'period'=>'required|date',
            ]);
            if ($validation->fails()){
                return response()->json([
                    'success'=>false,
                    'message'=>$validation->errors()->all(),
                ]);
            }else{
                $bill->update($validation->validated());
                return response()->json([
                    'success'=>true,
                    'message'=>'Bill updated successfully '
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
        try {
            $bill=Bill::find($id);

            if($bill){
                $bill->delete();
                return response()->json([
                    'success'=>true,
                    'message'=>'Bill deleted successfully'
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
