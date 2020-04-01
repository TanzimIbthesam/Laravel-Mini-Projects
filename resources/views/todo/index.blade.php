@extends('todo.layouts')

@section('content')
<h1 class="text-2xl">List of your own ToDos</h1>
@foreach ($todos as $todo)
<ul>
    <li>{{$loop->index+1}}</li>
    <li>{{$todo->title}}</li>
    @endforeach
</ul>



@endsection

