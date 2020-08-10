<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;

use Illuminate\Http\Request;
use App\BlogCategory;
use App\User;

class AdminController extends Controller
{
    //
    public function addTag(Request $request)
    {
        //validate
        $this->validate($request,[
            'tagName'=>'required'

        ]);
         return Tag::create([
            'tagName'=>$request->tagName
        ]);
    }
    public function editTag(Request $request)
    {
        //validate
        $this->validate($request, [
            'tagName' => 'required',
            'id'=>'required'

        ]);
        return Tag::where('id',$request->id)->update([
            'tagName'=>$request->tagName
        ]);
        // return response()->json([
        //           'tagName'=>$request->tagName
        // ]);
    }
   public function getTag()
   {
        return Tag::all();
   }
   public function deleteTag(Request $request){
        //validate request
        $this->validate($request, [

            'id' => 'required'

        ]);
        return Tag::where('id', $request->id)->delete();

   }
   public function upload(Request $request){

        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png',
        ]);
        $picName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $picName);
        return $picName;

   }

   public function deleteFileFromServer($fileName,$hasfullPath=false){
       if(!$hasfullPath){
            $filePath = public_path() . '/uploads/' . $fileName;
       }

        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        return;
   }
    public function deleteImage(Request $request)
    {
        $fileName = $request->imageName;
        $this->deleteFileFromServer($fileName,false);
        return "done";
    }
    public function addCategory(Request $request){
        $this->validate($request, [
            'categoryName' => 'required',
            'iconImage'=>'required'


        ]);
        return Category::create([
            'categoryName' => $request->categoryName,
             'iconImage'=>$request->iconImage
        ]);
    }
    public function getCategory()
    {
        return Category::all();
    }
    public function editCategory(Request $request)
    {
        //validate
        $this->validate($request, [
            'categoryName' => 'required',
            'iconImage'=>'required'

        ]);
        return Category::where('id',$request->id)->update([
            'categoryName' => $request->categoryName,
            'iconImage'=>$request->iconImage
        ]);
    }
    public function deleteCategory(Request $request)
    {
        // first delete the original file from the server
        $this->deleteFileFromServer($request->iconImage);
        // validate request
        $this->validate($request, [
            'id' => 'required',
        ]);
        return Category::where('id', $request->id)->delete();
    }
    public function createUser(Request $request)
    {
        // validate request
        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
             'userType'=>'required'

        ]);
        $password = bcrypt($request->password);
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $password,
            'userType'=>$request->userType

        ]);
        return $user;
    }
    public function getUser()
    {
        // $users=User::all();
        // return $users;
        return User::all();
    }
    public function editUser(Request $request)
    {
        // validate request
        $this->validate($request, [
            'fullname' => 'required',
            'email' => "bail|required|email|unique:users,email,$request->id",
            'password' => 'min:6',
            'userType' => 'required',
        ]);
        $data = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'userType' => $request->userType,
        ];
        if ($request->password) {
            $password = bcrypt($request->password);
            $data['password'] = $password;
        }
        $user = User::where('id', $request->id)->update($data);
        return $user;
    }
}
