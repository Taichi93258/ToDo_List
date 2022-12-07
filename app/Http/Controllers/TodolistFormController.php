<?php

namespace App\Http\Controllers;

use app\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class TodolistFormController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->get();

        $estimate_hour_sum = 0;
        foreach ($posts as $post) {
            $estimate_hour_sum += $post->estimate_hour;
        }

        return view('todo_list', compact('posts', 'estimate_hour_sum'));
    }

    public function createPage()
    {
        return view('todo_create');
    }

    public function create(PostRequest $request)
    {
        $post = new Post();
        $post->task_name = $request->task_name;
        $post->task_description = $request->task_description;
        $post->assign_person_name = $request->assign_person_name;
        $post->estimate_hour = $request->estimate_hour;
        $post->save();

        $posts = Post::orderBy('id', 'asc')->get();

        $estimate_hour_sum = 0;
        foreach ($posts as $post) {
            $estimate_hour_sum += $post->estimate_hour;
        }

        return view('todo_list', compact('posts', 'estimate_hour_sum'));
    }

    public function editPage($id)
    {
        $post = Post::find($id);
        return view('todo_edit', compact('post'));
    }

    public function edit(PostRequest $request)
    {
        Post::find($request->id)->update([
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'assign_person_name' => $request->assign_person_name,
            'estimate_hour' => $request->estimate_hour
        ]);

        $posts = Post::orderBy('id', 'asc')->get();

        $estimate_hour_sum = 0;
        foreach ($posts as $post) {
            $estimate_hour_sum += $post->estimate_hour;
        }

        return view('todo_list', compact('posts', 'estimate_hour_sum'));
    }

    public function deletePage($id)
    {
        $post = Post::find($id);
        return view('todo_delete', compact('post'));
    }

    public function delete(Request $request)
    {
        Post::find($request->id)->delete();
        $posts = Post::orderBy('id', 'asc')->get();

        $estimate_hour_sum = 0;
        foreach ($posts as $post) {
            $estimate_hour_sum += $post->estimate_hour;
        }

        return view('todo_list', compact('posts', 'estimate_hour_sum'));
    }
}