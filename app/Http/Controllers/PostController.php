<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Facades\FacadeEstimation;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Request $request)
    {
        $posts = $post->fetchPostWithTags($request);
        $estimate_hour_sum = FacadeEstimation::estimate($posts);
        $select_tags = $post->checkSelectTags($request);

        return view('todo/list', compact('posts', 'estimate_hour_sum', 'select_tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post)
    {
        $post->createPost($request);
        return redirect()->route('posts.index');
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
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        return view('todo/edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->updatePost($request);
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post)
    {
        $this->authorize('delete', $post);
        return view('todo/delete', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->deletePost();
        return redirect()->route('posts.index');
    }

    public function mypage(Post $post)
    {
        $posts = $post->findLoginUser(auth()->id());
        $estimate_hour_sum = FacadeEstimation::estimate($posts);

        return view('mypage', compact('posts', 'estimate_hour_sum'));
    }

    public function release(Request $request, Post $post)
    {
        $post->updatePostRelease($request);

        return redirect()->route('posts.index');
    }
}
