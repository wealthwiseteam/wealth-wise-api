<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tip;
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
        try{
            $tips=Tip::all();
            if($tips){
                return response()->json([
                    'success'=>true,
                    'tip'=>$tips
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ]);
        }
    }

    public function show(string $id){
        try{
            $tip=Tip::find($id);
            if($tip){
                return response()->json([
                    'success'=>true,
                    'tip'=>$tip
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Tip Not found'
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
