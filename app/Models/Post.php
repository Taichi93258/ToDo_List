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

    public function getUser()
    {
        return $this->with('user')->get();
    }

    public function getLoginUser()
    {
        return $this->where('user_id', auth()->id())->get();
    }

    public function savePost(PostRequest $request)
    {
        $this->create($request->all() + ['user_id' => auth()->id()]);
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
