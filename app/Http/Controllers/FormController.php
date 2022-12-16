<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Facades\FacadeEstimation;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        $estimate_hour_sum = FacadeEstimation::estimate($posts);

        return view('todo_list', compact('posts', 'estimate_hour_sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->create($request->all() + ['user_id' => auth()->id()]);

        return redirect()->route('todolists.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($todolist)
    {
        return view('todo_edit')->with('post', Post::find($todolist));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request)
    {
        return redirect()->route('todolists.index')->with(Post::find($request->todolist)->update($request->all()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($todolist)
    {
        return view('todo_delete')->with('post', Post::find($todolist));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return redirect()->route('todolists.index')->with(Post::find($request->todolist)->delete());
    }

    public function mypage()
    {
        $posts = Post::where('user_id', auth()->id())->get();

        $estimate_hour_sum = FacadeEstimation::estimate($posts);

        return view('mypage', compact('posts', 'estimate_hour_sum'));
    }
}