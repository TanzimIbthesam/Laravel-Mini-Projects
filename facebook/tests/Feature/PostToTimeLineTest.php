<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Post;

use Tests\TestCase;


class PostToTimeLineTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
  public function a_user_can_post_a_text_post()
  {
      $this->withoutExceptionHandling();
      $this->actingAs($user=factory(User::class)->create(),'api');

      $response =$this->post('/api/posts',[
          'data'=>[
              'type'=>'posts',
              'attributes'=>[
                  'body'=>'Testing body'
              ]
          ]

      ]);
        $post =(Post::class)::first();
      $response->assertStatus(201);
  }
}
