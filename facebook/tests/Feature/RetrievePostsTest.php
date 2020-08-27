<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RetrievePostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_user_can_retrieve_posts()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create(), 'api');
        $posts = factory(\App\Post::class, 2)->create();

        $response = $this->get('/api/posts');

        //  $response->assertStatus(200)
        //  ->assertJson([
        //      'data'=>[
        //         'data' => [
        //             'type' => 'posts',
        //             'post_id ' => $posts->first()->id,
        //             'attributes' => [
        //                 'body' => $posts->first()->body,
        //             ]
        //         ],
        //         'data' => [
        //             'type' => 'posts',
        //             'post_id ' => $posts->last()->id,
        //             'attributes' => [
        //                 'body' => $posts->last()->body,
        //             ]
        //         ],


        //     ],
        //     'links' => [
        //         'self' => url('/posts')
        //     ]


        //  ]);
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'posts',
                            'post_id' => $posts->last()->id,
                            'attributes' => [
                                'body' => $posts->last()->body,
                               'image' => $posts->last()->image,
                                'posted_at'=>$posts->last()->created_at->diffForHumans(),


                            ]
                        ]
                    ],
                    [
                        'data' => [
                            'type' => 'posts',
                            'post_id' => $posts->first()->id,
                            'attributes' => [
                                'body' => $posts->first()->body,
                                 'image'=> $posts->first()->image,
                            'posted_at' => $posts->first()->created_at->diffForHumans(),
                            'posted_by'=>[
                                'data'=>[
                                    'name'=>'',
                                ]
                            ]
                            ]
                        ]
                    ]
                ],
                'links' => [
                    'self' => url('/posts/'),
                ]
            ]);
    }
    /**
     * @test
     */
    public function a_user_can_only_retrieve_their_posts()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(User::class)->create(), 'api');
        $posts = factory(\App\Post::class)->create();

        $response = $this->get('/api/posts');
        $response->assertStatus(200)
        ->assertExactJson([
            'data' =>[],
               'links' => [
                'self' => url('/posts'),
            ]
        ]);
    }
}
