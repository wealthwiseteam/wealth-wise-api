<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $categories=Category::all();
            if($categories){
                return response()->json([
                   'success'=>true,
                   'category'=>$categories
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
    public function store(Request $request)
    {
        try{
            $validation=Validator::make($request->all(),[
               'name'=>'required|string|min:10|max:100|unique:categories',
                'description'=>'required',
                'is_active'=>'required|boolean',
                'icon'=>'string',
                'color'=>'string'
            ]);
            if($validation->fails()){
                return response()->json([
                   'success'=>false,
                   'message'=>$validation->errors()->all(),
                ]);
            }else{
                $result=Category::create($validation->validated());
                if($result){
                    return response()->json([
                        'success'=>true,
                        'message'=>"Category Add Successfully"
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
    public function show(string $id)
    {
        try{
            $category=Category::find($id);
            if($category){
                return response()->json([
                    'success'=>true,
                    'category'=>$category
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Category Not found'
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
    public function update(Request $request, string $id)
    {
        try{
            $category=Category::findOrFail($id);
            $validation=Validator::make($request->all(),[
                'name'=>'required|string|min:10|max:100|unique:categories',
                'description'=>'required',
                'is_active'=>'required|boolean',
                'icon'=>'string',
                'color'=>'string'
            ]);
            if ($validation->fails()){
                return response()->json([
                   'success'=>false,
                   'message'=>$validation->errors()->all(),
                ]);
            }else{
                $category->update($validation->validated());
                return response()->json([
                   'success'=>true,
                    'message'=>'Category updated successfully '
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
    public function destroy(string $id)
    {
        try {
            $category=Category::find($id);

            if($category){
                $category->bills()->delete();
                $category->budgets()->delete();
                $category->plans()->delete();
                $category->delete();
                return response()->json([
                    'success'=>true,
                    'message'=>'Category deleted successfully'
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
