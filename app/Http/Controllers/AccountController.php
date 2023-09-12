<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/accounts",
     *     summary="Get a list of bills",
     *     tags={"Account"},
     *     @OA\Response(
     *         response=200,
     *         description="List of accounts",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Account") // This should reference an existing schema
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */

    public function index()
    {
        try{
            $accounts=Account::all();
            if($accounts){
                return response()->json([
                    'success'=>true,
                    'account'=>$accounts
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
     *     path="/api/accounts",
     *     summary="Create a new account",
     *     tags={"Account"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Account data",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful account creation")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Account created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful account creation")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        try{
            $validation=Validator::make($request->all(),[
                'name'=>'required|string|max:100|unique:accounts',
                'user_id'=>'required|exists:users,id',
                'amount'=>'required|numeric',
                'type'=>'required|in:Credit Card,E-wallet',
            ]);
            if($validation->fails()){
                return response()->json([
                    'success'=>false,
                    'message'=>$validation->errors()->all(),
                ]);
            }else{
                $result=Account::create($validation->validated());
                if($result){
                    return response()->json([
                        'success'=>true,
                        'message'=>"Account Add Successfully"
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
     *     path="/api/account/{id}",
     *     summary="Get a specific account by ID",
     *     tags={"account"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the account to retrieve",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Account details",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Account"))
     *     )
     * )
     */

    public function show(string $id)
    {
        try{
            $account=Account::find($id);
            if($account){
                return response()->json([
                    'success'=>true,
                    'account'=>$account
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Account Not found'
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
     *     path="/api/account/{id}",
     *     summary="Update a specific account by ID",
     *     tags={"accounts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the account to update",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated account data",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful account update")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="account updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", description="A message indicating successful account update")
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        try{
            $account=Account::findOrFail($id);
            $validation=Validator::make($request->all(),[
                'name'=>'required|string|max:100|unique:accounts',
                'user_id'=>'required|exists:users,id',
                'amount'=>'required|numeric',
                'type'=>'required|in:Credit Card,E-wallet',
            ]);
            if ($validation->fails()){
                return response()->json([
                    'success'=>false,
                    'message'=>$validation->errors()->all(),
                ]);
            }else{
                $account->update($validation->validated());
                return response()->json([
                    'success'=>true,
                    'message'=>'Account updated successfully '
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
     *     path="/api/accounts/{id}",
     *     summary="Delete a specific account by ID",
     *     tags={"Bills"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the account to delete",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No account for delete"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        try {
            $account=Account::find($id);

            if($account){
                $account->delete();
                return response()->json([
                    'success'=>true,
                    'message'=>'Account deleted successfully'
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
