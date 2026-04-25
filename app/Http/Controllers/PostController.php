<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        DB::table('posts')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/posts');
    }

    public function show($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        DB::table('posts')->where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'updated_at' => now(),
        ]);

        return redirect('/posts');
    }

    public function destroy($id)
    {
        DB::table('posts')->where('id', $id)->delete();
        return redirect('/posts');
    }
}