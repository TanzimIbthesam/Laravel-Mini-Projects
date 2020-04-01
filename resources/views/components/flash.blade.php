
<div>
    @if(session()->has('message'))
{{-- //For Booststrap --}}
{{-- <div class="alert alert-success">
{{session()->get('message')}}
</div> --}}
<div class="py-4 px-2 bg-green-400">
{{session()->get('message')}}
</div>

{{-- @elseif(session()->has('error'))
<div class="alert alert-danger">
  {{session()->get('error')}}


    </div> --}}

  @endif

      @if ($errors->any())


              @foreach ($errors->all() as $error)
                  {{-- <p class="text-danger">{{$error}}</p> --}}
{{--                  //Bootstrap
                      <div class="alert alert-danger">
                          {{$error}}
                      </div>
                      {{-- <div class="py-4 px-2 bg-red-400">
                        {{session()->get('error')}}
                        </div> --}}
                        <div class="py-4 px-2 bg-red-400">
                            {{$error}}
                            </div>

              @endforeach


  @endif

</div>
