<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['release'];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'post_tag');
        ;
    }

    public function fetchPostWithUser()
    {
        return $this->with('user')->get();
    }

    public function findLoginUser($user_id)
    {
        return $this->where('user_id', $user_id)->get();
    }

    public function savePost($request)
    {
        $this->create($request);
    }

    public function updatePost($request)
    {
        $this->update($request->all());
    }

    public function deletePost()
    {
        $this->delete();
    }

    public function updatePostRelease($request)
    {
        foreach ($request->input('release') as $value) {
            $this->find($value['post_id'])
            ->update(['release' => $value['release']]);
        }
    }

    public function searchTags($request)
    {
        $query = Post::query();

        $query->whereHas(['tags' => function ($query) use ($request) {
            $query->where('tags->id', 'like', $request);
        }])->get();
    }
}