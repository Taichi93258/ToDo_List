<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\PostRequest;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function fetchPostWithUser()
    {
        return $this->with('user')->get();
    }

    public function findLoginUser()
    {
        return $this->where('user_id', auth()->id())->get();
    }

    public function savePost($request)
    {
        $this->create($request);
    }

    public function updatePost(PostRequest $request)
    {
        $this->update($request->all());
    }

    public function deletePost()
    {
        $this->delete();
    }
}
