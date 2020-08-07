<?php

namespace App\Http\Controllers;

use App\Http\Resources\Student as StudentResource;
use App\Student;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $students=new Student();
        $students->first_name=$request->input('first_name');
        $students->last_name=$request->input('last_name');
        $students->course=$request->input('course');
        $students->section=$request->input('section');

        $students->save();
      return response()->json($students);
     //return new StudentResource($students);
         return StudentResource::collection($students);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $students=Student::all();
         return response()->json($students);
    return StudentResource::collection($students);
    //   return response()->json($students);
    }
    public function showbyid($id)
    {
        //
        $students=Student::find($id);
          return response()->json($students);
    return StudentResource::collection($students);
    //   return response()->json($students);
    }
   public function updatebyid(Request $request,$id)
   {
       $students=Student::find($id);
       if($students){
            $students->first_name = $request->input('first_name');
            $students->last_name = $request->input('last_name');
            $students->course = $request->input('course');
            $students->section = $request->input('section');

            $students->save();
            return response()->json($students);
          return StudentResource::collection($students);

       }
   }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students=Student::find($id);
        if($students){
            $students->delete();
            return response()->json($students);
            return StudentResource::collection($students);
        }
    }
}
