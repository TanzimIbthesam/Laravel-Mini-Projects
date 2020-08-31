<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FriendsTest extends TestCase
{
    /** @test */
   use RefreshDatabase;
    public function a_user_can_send_a_friend_request()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user=factory(User::class)->create(),'api');
        $anotherUser= factory(User::class)->create();

        $response=$this->post('/api/friend-request',[
            'friend_id'=>$anotherUser->id,

        ])->assertStatus(200);

        $friendRequest=\App\Friend::first();

        $this->assertNotNull($friendRequest);

        $this->assertEquals($anotherUser->id,$friendRequest->friend_id);
        $this->assertEquals($user->id,$friendRequest->user_id);

        $response->assertJson([
            'data'=>[
            'type'=>'friend-request',
             'friend_request_id'=>$friendRequest->id,
             'attributes'=>[
                 'confirmed_at'=>null,
             ]
             ],
             'links'=>[
                 'self'=>url('/users/'.$anotherUser->id)
             ]

        ]);

    }
    /** @test */
    public function only_valid_users_can_be_friend_requested()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create(), 'api');


        $response = $this->post('/api/friend-request', [
            'friend_id' =>123,

        ])->assertStatus(404);

        // $friendRequest = \App\Friend::first();

         $this->assertNull(\App\Friend::first());
         $response->assertJson([
             'errors'=>[
                 'code'=>404,
                 'title'=>'User not found',
                 'detail'=>'Unable to locate user with given information'
             ]
         ]);
    }
}
