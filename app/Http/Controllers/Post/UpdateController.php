<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class UpdateController extends Controller
{
    public function __invoke(Post $post)
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
}
