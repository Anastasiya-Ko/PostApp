<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

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
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $date = request() -> validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string'
        ]);
        Post::update($date);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
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
