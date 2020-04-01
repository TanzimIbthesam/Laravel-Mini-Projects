@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <div class="card mt-3">
                  <div class="card-header">
               <h1>File Upload Form</h1>
                  </div>
                  <div class="card-body">
                   {{-- @include('component.flash') --}}
                   {{-- <x-flash /> --}}
                   <x-flash>
                       <div class="alert alert-danger">
                              It comes from components/flash
                       </div>
                   </x-flash>
                    <form action="/upload" method="post"enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" id="" class="form-control" ><br>
                        <input type="submit" value="Submit" name="Upload"class="form-control">
                       </form>
                  </div>

                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
