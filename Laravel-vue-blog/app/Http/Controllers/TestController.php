<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function new(){
   return view('welcome');
        // echo "Hello Worldddd";
    }
    public function newmethod(){
        return response()->json([
               'msg'=>'We must return only json'
        ]);
    }
    public function test(){
          return response()->json([
              'msg'=>'Some error occured'

          ],422);
    }
}
