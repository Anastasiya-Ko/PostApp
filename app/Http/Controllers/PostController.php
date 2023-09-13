<?php

namespace App\Http\Controllers;

use App\Models\Post;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', 0)->get();
        foreach ($posts as $post) {
            dump($post->title);
        }
        dd('end');
    }

    public function create()
    {
        $postsArr = [
            [
                'title' => 'first created post',
                'content' => 'some post',
                'image' => 'image',
                'likes' => 50,
                'is_published' => 1,
            ],
            [
                'title' => 'second created post',
                'content' => 'some post',
                'image' => 'image',
                'likes' => 40,
                'is_published' => 1,
            ]
        ];

        foreach ($postsArr as $item) {
            Post::create($item);
        }
        dd('created');
    }

    public function update()
    {
        $post = Post::find(5);
        $post->update([
            'title' => 'updated post',
            'content' => 'some post',
            'image' => 'image',
            'likes' => 20,
            'is_published' => 1,
        ]);
        dd('updated');
    }

    public function restoreAfterSoftDelete()
    {
        Post::where('id', 1)
            ->withTrashed()
            ->update([
                'deleted_at' => null
            ]);
    }

    public function firstOrCreate()
    {
        $anotherPost = [
            'title' => 'firstOrCreate post',
            'content' => 'firstOrCreate content',
            'image' => 'some image',
            'likes' => 200,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate([
            'title' => 'firstOrCreate post'
        ], [
            'title' => 'firstOrCreate post',
            'content' => 'firstOrCreate content',
            'image' => 'some image',
            'likes' => 200,
            'is_published' => 1
        ]);

        dump($post->content);
        dd('finished');
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'up post',
            'content' => 'up content',
            'image' => 'up image',
            'likes' => 10,
            'is_published' => 1,
        ];

        $post = Post::updateOrCreate([
            'title' => 'updated post'
        ], $anotherPost);

        dump($post->content);
        dd('finished');
    }

}
