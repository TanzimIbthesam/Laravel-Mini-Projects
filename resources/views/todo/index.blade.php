{{-- @extends('layouts.app') --}}
 @extends('todo.layouts')

@section('content')
<x-flash/>
<div class="flex justify-center border-b pb-4">
    <h1 class="text-2xl ">List of your own ToDos</h1>
    <a href="todos/create" class="px-1 py-1 bg-orange-500 cursor-pointer text-white rounded mx-4" target="_blank">Create New </a>
</div>


@foreach ($todos as $todo)
<ul class="my-3">

    <li class="flex justify-between p-2">
        @if($todo->completed)
        <p class="line-through text-red-500">{{$loop->index+1}}-{{$todo->title}}</p>
       @else
       <p class="">{{$loop->index+1}}-{{$todo->title}}</p>
       @endif
<div>

    <a href="{{'/todos/edit/'.$todo->id}}" class="px-1 py-1  cursor-pointer text-white rounded mx-4" target="_blank"><span  class="fas fa-edit text-yellow-500"></span></a>
    @if($todo->completed)
    <span class="fas fa-check text-green-300 cursor-pointer"></span>
    @else
    <span class="fas fa-check text-gray-300 cursor-pointer"></span>
    @endif
</div>


    </li>


    @endforeach
</ul>



@endsection


