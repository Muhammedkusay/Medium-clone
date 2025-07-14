<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $posts = Post::with('user')
                ->withCount('claps')
                ->orderBy('created_at', 'desc')
                ->paginate(5);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('post.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048',
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'published_at' => 'nullable|datetime',
        ]);

        // $image = $data['image'];
        // unset($data['image']);
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title']);

        // $imagePath = $image->store('posts', 'public');
        // $data['image'] = $imagePath;

        $post = Post::create($data);
    
        $post->addMediaFromRequest('image')->toMediaCollection();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if($post->user_id !== Auth::id()) {
            abort(403);
        } 

        $categories = Category::get();

        return view('post.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id !== Auth::id()) {
            abort(403);
        } 

        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048',
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'published_at' => 'nullable|datetime',
        ]);

        $post->update($data);

        if($data['image'] ?? false) {
            $post->addMediaFromRequest('image')->toMediaCollection();
        }

        return redirect()->route('post.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->user_id !== Auth::id()) {
            abort(403);
        } 
        else {
            $post_title = $post->title;
            $post->delete();
            return redirect()->route('dashboard')->with('status', '"'.$post_title.'"' . ' post is successfully deleted');
        }
    }   

    public function category(Category $category)
    {
        $posts = $category
            ->posts()
            ->with('user')
            ->withCount('claps')
            ->latest()
            ->simplePaginate(5);

        return view('post.index', ['posts' => $posts]);
    }

    // public function userPosts()
    // {
    //     $user = auth()->user();
    //     $posts = $user->posts()->withCount('claps')->paginate(5);

    //     return view('profile.show', [
    //         'user' => $user,
    //         'posts' => $posts,
    //     ]);
    // }
}
