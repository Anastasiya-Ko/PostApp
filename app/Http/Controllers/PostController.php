<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::find(1);
        $category = Category::find(1);
        $tag = Tag::find(3);
        dd($post->tags);

        return view('post.index', compact('post'));
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
           'title' => 'required|string',
           'content' => 'string',
           'image' => 'string',
            'category_id' => '',
            'tags' => ''
        ]);

        $tags=$data['tags'];
        unset($data['tags']);

        $post = Post::create($data);

        $post->tags()->withTimeStamps()->attach($tags);

        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request() -> validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => ''

        ]);
        $tags=$data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->withTimestamps()->sync($tags);
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
