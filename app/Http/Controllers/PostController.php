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
        $categories = Category::all();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('post.create', compact('categories', 'tags'));

    }

    public function store()
    {
        $data = request() -> validate([
           'title' => 'string',
           'content' => 'string',
           'image' => 'string',
            'category_id' => '',
            'tags' => ''
        ]);

        dd($data);
        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    public function update(Post $post)
    {
        $data = request() -> validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => ''

        ]);
        $post->update($data);
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
