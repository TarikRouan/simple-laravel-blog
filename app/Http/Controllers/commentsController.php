<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class commentsController extends Controller
{
    public function index(string $id)
    {
        return view('blog.comments.index', [
            'comments' => Comment::orderBy('updated_at', 'desc')->where('post_id', $id)->paginate(8)
        ]);
    }

    public function comments(Request $request)
    {
        $comments = Comment::whereIn('post_id', function ($query) {
            $query->select('id')
                ->from('posts')
                ->where('user_id', Auth::id());
        })
            ->orderBy('updated_at', 'desc')
            ->paginate(8);

        return view('blog.comments.full', [
            'comments' => $comments
        ]);
    }

    public function store(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'comment' => 'required',
            'email' => 'required',
        ]);

        Comment::create([
            'post_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);

        return redirect(URL::previous());
    }

    public function destroy(string $id)
    {
        Comment::destroy($id);

        return redirect(URL::previous());
    }
}
