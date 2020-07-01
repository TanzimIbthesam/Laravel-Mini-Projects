<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function new(){
    //    return view('welcome');
        echo "Hello World";
    }
    public function newmethod(){
        return response()->json([
               'msg'=>'We must return only json'
        ]);
    }
}
