<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request) {

        $query = $request->query('q');

        $users = User::whereAny([DB::raw('lower(name)'), DB::raw('lower(username)')], 'like', '%'.strtolower($query).'%')
        ->limit(5)
        ->get();

        $posts = Post::where(DB::raw('lower(title)'), 'like', '%'.strtolower($query).'%')
        ->limit(5)
        ->get();

        $suggestions = $users->merge($posts);

        return response()->json([
            'suggestions' => $suggestions,
        ]);

    }
}
