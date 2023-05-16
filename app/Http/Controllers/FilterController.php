<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{

    public function searchpub(Request $request)
    {
        $search = $request->search;

        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->paginate(8);

        return view('blog.index', [
            'posts' => $posts
        ]);
    }
    public function searchadm(Request $request)
    {
        $search = $request->search;

        $posts = Auth::user()->posts()
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%");
            })
            ->paginate(8);

        return view('dashboard', [
            'posts' => $posts
        ]);
    }
}
