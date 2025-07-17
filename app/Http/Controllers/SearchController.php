<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {

        $query = $request->query('q');

        $users = User::whereAny(['name', 'username'], 'like', '%'.$query.'%')
        ->limit(3)
        ->get();

        $posts = Post::where('title', 'like', '%'.$query.'%')
        ->limit(3)
        ->get();

        $suggestions = $users->merge($posts);

        return response()->json([
            'suggestions' => $suggestions,
        ]);

    }
}
