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
}