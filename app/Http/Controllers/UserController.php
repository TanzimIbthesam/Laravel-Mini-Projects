<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as ImageTwo;

use App\Http\Requests\ImageRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //

  public function avartarupload(ImageRequest $request){

      if($request->hasFile('image')){

          $filename=$request->image->getClientOriginalName();

         $request->image->storeAs('images',$filename,'public');

        $this->deleteOldImage();
        //   $request->image->storeAs('images',$filename,'public');

    //    User::find('1')->update(['avatar'=>$filename]);
        auth()->user()->update (['avatar'=>$filename]);
        // session()->put('message','Image Uploaded');
        // $request->session()->flash('message','Image Uploaded');
        //A more simplified version
        return redirect()->back()->with('message','Image Uploaded');
      }
    //   $request->session()->flash('error','Image Not Uploaded');
      return redirect()->back()->with('error','Image Not Uploaded');
      return redirect()->back();

  }
  public function deleteOldImage(){
    if(auth()->user()->avatar){
        //   dd('/public/images/'.auth()->user()->avatar);
          Storage::delete('/public/images/'.auth()->user()->avatar);
      }
  }
}
