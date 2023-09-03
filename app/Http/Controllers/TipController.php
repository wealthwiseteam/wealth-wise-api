<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function show(){
        return response([
            'message'=>'this is show method to show all tips and advices',
        ]);
    }
}
