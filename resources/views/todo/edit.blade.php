@extends('todo.layouts')
@section('content')
<h1 class="text-2xl border-b pb-4">Update this Todo List</h1>

<form action="{{route('todo.update',$todo->id)}}" method="post"  class="py-5">
    <x-flash />
    @csrf
    @method('patch')
    <input type="text" name="title" value={{$todo->title}} class="py-2 px-2 border rounded border-teal-300" id="">
    <input type="submit" value="Update" id=""class="p-2  border rounded-lg">

</form>
<a href="/todos" class="px-1 py-1  cursor-pointer border rounded mx-4" >Back</a>
@endsection








