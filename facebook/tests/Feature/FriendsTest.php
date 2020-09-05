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
                    'friend_id'=>$friendRequest->friend_id,
                    'user_id'=>$friendRequest->user_id


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

        $response = $this->actingAs($user=factory(User::class)->create(), 'api')
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
    /** @test */
    public function a_friend_id_is_required_for_friend_requests()
    {
       $response= $this->actingAs(factory($user=User::class)->create(), 'api')
      ->post('/api/friend-request', [
            'friend_id' =>'',
        ]);
        //   $responseString=json_decode($response->getContent(),true);
        //    $this->assertArrayHasKey('friend_id',$responseString['errors']['meta']);

        $responseString = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('friend_id', $responseString['errors']['meta']);
    }
    /** @test */
    public function a_user_id_and_status_is_required_for_friend_request_response()
    {

        $response = $this->actingAs($user=factory(User::class)->create(), 'api')
        ->post('/api/friend-request-response',[
            'user_id'=>' ',
            'status'=> ' ',

        ])->assertStatus(422);
        $responseString = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('user_id', $responseString['errors']['meta']);
        $this->assertArrayHasKey('status', $responseString['errors']['meta']);
    }
         /** @test */
            public function a_friendship_is_retrieved_when_fetching_the_profile( )
            {
             $this->actingAs($user=factory(\App\User::class)->create(), 'api');
            $anotherUser=factory(\App\User::class)->create();
            $friendRequest=\App\Friend::create([
                 'user_id'=>$user->id,
                 'friend_id'=>$anotherUser->id,
                 'confirmed_at'=>now()->subDay(),
                 'status'=>1,
            ]);

        $this->get('/api/users/' . $anotherUser->id)

        ->assertStatus(200)
        ->assertJson([
            'data' => [
               'attributes'=>[
                   'friendship'=>[
                      'data'=>[
                          'friend_request_id'=>$friendRequest->id,
                          'attributes'=>[
                              'confirmed_at'=>'1 day ago',
                          ]
                      ]
                   ]
               ]

            ],


        ]);

            }

    /** @test */
    public function an_inverse_friendship_is_retrieved_when_fetching_the_profile()
    {
        $this->actingAs($user = factory(\App\User::class)->create(), 'api');
        $anotherUser = factory(\App\User::class)->create();
        $friendRequest = \App\Friend::create([
            'friend_id' => $user->id,
            'user_id' => $anotherUser->id,
            'confirmed_at' => now()->subDay(),
            'status' => 1,
        ]);

        $this->get('/api/users/' . $anotherUser->id)

            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'attributes' => [
                        'friendship' => [
                            'data' => [
                                'friend_request_id' => $friendRequest->id,
                                'attributes' => [
                                    'confirmed_at' => '1 day ago',
                                ]
                            ]
                        ]
                    ]

                ],


            ]);
    }
    /** @test */
    public function friend_requests_can_be_ignored()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');
        $anotherUser = factory(User::class)->create();

        $this->post('/api/friend-request', [
            'friend_id' => $anotherUser->id,
        ])->assertStatus(200);

        $response = $this->actingAs($anotherUser, 'api')
        ->delete('/api/friend-request-response/delete', [
            'user_id' => $user->id,


        ])->assertStatus(204);
        $friendRequest = \App\Friend::first();
        $this->assertNull($friendRequest);
        $response->assertNoContent();




    }
    /** @test */
    public function only_receiptent_can_ignore_a_friend_request()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');
        $anotherUser = factory(User::class)->create();

        $this->post('/api/friend-request', [
            'friend_id' => $anotherUser->id,
        ])->assertStatus(200);

        $response = $this->actingAs($user = factory(User::class)->create(), 'api')
        ->delete('/api/friend-request-response/delete', [
            'user_id' => $user->id,


        ])->assertStatus(404);
        $friendRequest = \App\Friend::first();
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
    /** @test */
    public function a_user_id_is_required_for_ignoring_a_friend_request_response()
    {

        $response = $this->actingAs($user = factory(User::class)->create(), 'api')
        ->delete('/api/friend-request-response/delete', [
            'user_id' => ' ',


        ])->assertStatus(422);
        $responseString = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('user_id', $responseString['errors']['meta']);

    }

    }



