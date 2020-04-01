<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoValidator;
use App\Todo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    public function index(){
        $todos=Todo::all();
//  return view('todo.index',compact('todos'));
 return view('todo.index')->with(['todos'=>$todos]);
    }
    public function create(){
 return view('todo.create');
    }
    public function edit(){
 return view('todo.edit');
    }
    public function store(TodoValidator $request){
        //   dd($request->all());
        // $request->validate([
        //     'title'=>'required|max:255',

        // ]);
        // $rules=[
        //     'title'=>'required|max:255'

        // ];
        // $messages=[
        //     'title.required'=>'The title field must be fulfilled',
        //     'title.max'=>'Title field must have less than 250 characters'
        // ];
        // $validator = Validator::make($request->all(), $rules,$messages);

        // if ($validator->fails()) {
        //     return redirect()
        //              ->back()
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
        Todo::create($request->all());
    return redirect()->back()->with('message','Todo Created Successfully');
    // return redirect()->back()->with('error','Todo not submitted');
    }



}
