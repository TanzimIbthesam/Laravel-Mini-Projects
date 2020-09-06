<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\ValidationErrorException;
use App\Http\Resources\Friend as FriendResource;

use App\Friend;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FriendRequestController extends Controller
{
    //
    public function store()
    {
        $data = request()->validate([
            'friend_id' => 'required'

        ]);
        //try catch later handeled by Handler.php
        // try {
        //     $data = request()->validate([
        //         'friend_id' => 'required'

        //     ]);
        //     //code...

        // } catch (ValidationException $e) {

        //             //  throw new ValidationErrorException(json_encode($e->errors()));
        // }
        try {
            User::findOrFail($data['friend_id'])
                ->friends()->syncWithoutDetaching(auth()->user());
        } catch (ModelNotFoundException $e) {
            //throw $th;
            throw new UserNotFoundException();
        }

        //    Friend::create($data);

        return new FriendResource(
            Friend::where('user_id', auth()->user()->id)
                ->where('friend_id', $data['friend_id'])
                ->firstOrFail()
        );
    }
}
