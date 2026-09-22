<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;

class InsightController extends Controller
{
    public function index(): View
    {
        return view('insights.index', [
            'posts' => Post::published()->with(['author', 'category', 'featuredImage'])->latest('published_at')->paginate(9),
        ]);
    }

    public function show(Post $post): View
    {
        abort_unless(Post::published()->whereKey($post->getKey())->exists(), 404);

        return view('insights.show', ['post' => $post->load(['author', 'category', 'featuredImage', 'tags'])]);
    }
}
