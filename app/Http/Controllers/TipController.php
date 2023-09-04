<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/tips",
     *     summary="List all tips",
     *     tags={"Tips"},
     *     @OA\Response(
     *         response=200,
     *         description="List of tips",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/tips"))
     *     )
     * )
     */
    public function index(){
        return response([
            'message'=>'this is show method to show all tips and advices',
        ]);
    }

    public function show(){
        return response([
            'message'=>'this is show method in tip controller to show one tip'
        ]);
    }
}
