<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $relatedPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->whereHas('tags', function ($query) use ($post) {
                $query->whereIn('tags.id', $post->tags->pluck('id'));
            })
            ->withCount(['tags' => function ($query) use ($post) {
                $query->whereIn('tags.id', $post->tags->pluck('id'));
            }])
            ->orderBy('tags_count', 'desc')
            ->take(4)
            ->get();

        if ($relatedPosts->count() < 4){
            $relatedPosts2 = Post::where('is_published', true)
                ->where('id', '!=', $post->id)
                ->where('category_id', $post->category_id)
                ->whereNotIn('id', $relatedPosts->pluck('id'))
                ->orderBy('id', 'desc')
                ->take(4 - $relatedPosts->count())
                ->get();

            $relatedPosts = $relatedPosts->merge($relatedPosts2);
        }

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
