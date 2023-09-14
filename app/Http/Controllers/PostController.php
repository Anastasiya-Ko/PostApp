<?php

namespace App\Http\Controllers;

use App\Models\Post;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');

    }

    public function store()
    {
        $date = request() -> validate([
           'title' => 'string',
           'content' => 'string',
           'image' => 'string'
        ]);
        Post::create($date);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        dd($post->title);
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
