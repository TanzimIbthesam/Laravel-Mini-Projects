<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoValidator;
use App\Todo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    //
 public function __construct()
 {
     $this->middleware('auth');
 }
    public function index(){
        $todos=Todo::all()->where('completed',0);
        // $todos=Todo::where('completed','DESC')->get();
//  return view('todo.index',compact('todos'));
 return view('todo.index')->with(['todos'=>$todos]);
    }
    public function create(){
 return view('todo.create');
    }
    public function store(TodoValidator $request){

        Todo::create($request->all());
    return redirect()->back()->with('message','Todo Created Successfully');
    // return redirect()->back()->with('error','Todo not submitted');
    }
    //Laravel 6
//     public function edit($id){
//         $todo=Todo::find($id);
//         // return $todo;
//         // dd($id);
//  return view('todo.edit',compact('todo'));
//     }
    //dynamic model binding from laravel 7
    public function edit(Todo $todo){
    //   dd($todo->title);
        // $todo=Todo::find($id);
        // return $todo;
        // dd($id);
 return view('todo.edit',compact('todo'));
    }
    public function update(TodoValidator $request, Todo $todo){
        $todo->update(['title'=>$request->title]);
        // $todo->update([$request->all()]);
        return redirect(route('todo.index'))->with('message','Todo Updated Successfully');

    }




}
