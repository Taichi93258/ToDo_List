<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class TodolistFormController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->get();
        return view('todo_list', [
            "posts" => $posts
        ]);
    }

    public function createPage()
    {
        return view('todo_create');
    }

    public function create(Request $request)
    {
        $post = new Post();
        $post->task_name = $request->task_name;
        $post->task_description = $request->task_description;
        $post->assign_person_name = $request->assign_person_name;
        $post->estimate_hour = $request->estimate_hour;
        $post->save();

        return redirect('/');
    }

    public function editPage($id)
    {
        $post = Post::find($id);
        return view('todo_edit', [
            "post" => $post
        ]);
    }

    public function edit(Request $request)
    {
        Post::find($request->id)->update([
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'assign_person_name' => $request->assign_person_name,
            'estimate_hour' => $request->estimate_hour
        ]);
        return redirect('/');
    }

    public function deletePage($id)
    {
        $post = Post::find($id);
        return view('todo_delete', [
            "post" => $post
        ]);
    }

    public function delete(Request $request)
    {
        Post::find($request->id)->delete();
        return redirect('/');
    }
}