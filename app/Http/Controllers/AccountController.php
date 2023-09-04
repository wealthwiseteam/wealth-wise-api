<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bill;
use Illuminate\Http\Request;

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
        $accounts=Account::all();
        return response($accounts);
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
        return response([
            'message'=>'this is store method in account controller'
        ]);
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
        return response([
            'message'=>'this is show method in bill controller to show one bill'
        ]);
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
        return response([
            'message'=>'this is update method in account controller'
        ]);
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
        return response([
            'message'=>'this is destroy method in account controller'
        ]);
    }
}
