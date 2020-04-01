@extends('todo.layouts')
@section('content')
<h1 class="text-2xl">What you need to do now?</h1>
<form action="" method="post" action="todo/create" class="py-5">
    <x-flash />
    @csrf
    <input type="text" name="title" class="py-2 px-2 border rounded border-teal-300" id="">
    <input type="submit" value="Create" id=""class="p-2  border rounded-lg">

</form>
@endsection


