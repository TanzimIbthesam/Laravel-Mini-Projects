<?php

namespace Tests\Feature;

use App\Friend;
use App\User;
use Carbon\Carbon;
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
    /** @test */
         public function friend_requests_can_be_accepted()
         {

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');
        $anotherUser = factory(User::class)->create();

         $this->post('/api/friend-request', [
            'friend_id' => $anotherUser->id,
         ])->assertStatus(200);

        $response=$this->actingAs($anotherUser,'api')
        ->post('/api/friend-request-response',[
            'user_id'=>$user->id,
            'status'=> 1,

        ])->assertStatus(200);

        $friendRequest = \App\Friend::first();
        $this->assertNotNull($friendRequest->confirmed_at);
        $this->assertInstanceOf(Carbon::class,$friendRequest->confirmed_at);
        $this->assertEquals(now()->startOfSecond(),$friendRequest->confirmed_at);
        $this->assertEquals(1, $friendRequest->status);

        $response->assertJson([
            'data' => [
                'type' => 'friend-request',
                'friend_request_id' => $friendRequest->id,
                'attributes' => [
                    'confirmed_at' =>$friendRequest->confirmed_at->diffForHumans(),

                ]
            ],
            'links' => [
                'self' => url('/users/' . $anotherUser->id)
            ]

        ]);

         }
               /** @test */
         public function only_valid_friend_requests_can_be_accepted()
         {
        $anotherUser = factory(User::class)->create();
        $response = $this->actingAs($anotherUser, 'api')
        ->post('/api/friend-request-response', [
            'user_id' =>123,
            'status' => 1,

        ])->assertStatus(404);

        $this->assertNull(\App\Friend::first());


        $response->assertJson([
            'errors' => [
                'code' => 404,
                'title' => 'Friend Request not found',
                'detail' => 'Unable to locate friend Request with given information'
            ]
        ]);

         }
    /** @test */
         public function only_receiptent_can_accept_a_friend_request()
         {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');
        $anotherUser = factory(User::class)->create();

        $this->post('/api/friend-request', [
            'friend_id' => $anotherUser->id,
        ])->assertStatus(200);

        $response = $this->actingAs(factory(User::class)->create(), 'api')
        ->post('/api/friend-request-response', [
            'user_id' => $user->id,
            'status' => 1,

        ])->assertStatus(404);
        $friendRequest= \App\Friend::first();
        $this->assertNull($friendRequest->confirmed_at);
        $this->assertNull($friendRequest->status);

        $response->assertJson([
            'errors' => [
                'code' => 404,
                'title' => 'Friend Request not found',
                'detail' => 'Unable to locate friend Request with given information'
            ]
        ]);
         }

}
