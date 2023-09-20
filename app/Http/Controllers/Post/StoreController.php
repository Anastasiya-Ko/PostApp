<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class StoreController extends Controller
{
    public function __invoke()
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
}
