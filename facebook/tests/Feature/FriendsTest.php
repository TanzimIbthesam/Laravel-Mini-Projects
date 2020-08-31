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
}
