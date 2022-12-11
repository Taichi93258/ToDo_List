<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Facades\FacadeEstimation;

class TodolistFormController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();

        $estimate_hour_sum = FacadeEstimation::estimate($posts);

        return view('todo_list', compact('posts', 'estimate_hour_sum'));
    }

    public function createPage()
    {
        return view('todo_create');
    }

    public function create(PostRequest $request)
    {
        $post = new Post();
        $post->create($request->all() + ['user_id' => auth()->id()]);

        return redirect()->route('todolist.index');
    }

    public function editPage($id)
    {
        $post = Post::find($id);
        return view('todo_edit', compact('post'));
    }

    public function edit(PostRequest $request)
    {
        Post::find($request->id)->update($request->all());

        return redirect()->route('todolist.index');
    }

    public function deletePage($id)
    {
        $post = Post::find($id);
        return view('todo_delete', compact('post'));
    }

    public function delete(Request $request)
    {
        Post::find($request->id)->delete();

        return redirect()->route('todolist.index');
    }

    public function MyPage()
    {
        $posts = Post::where('user_id', auth()->id())->get();

        $estimate_hour_sum = FacadeEstimation::estimate($posts);

        return view('mypage', compact('posts', 'estimate_hour_sum'));
    }
}