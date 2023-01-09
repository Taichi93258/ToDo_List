<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['task_name', 'release', 'task_description',
                        'estimate_hour', 'user_id', 'priority'];

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

    public function fetchPostWithTags($request)
    {
        if (!empty($request->tags)) {
            return  $this->whereHas('tags', function ($query) use ($request) {
                $query->whereIn('tags.id', $request->tags);
            })->get();
        } else {
            return $this->doesntHave('tags')->get();
        }
    }

    public function findLoginUser($user_id)
    {
        return $this->where('user_id', $user_id)->get();
    }

    public function createPost($request)
    {
        $post = $this->create($request->all());
        $post->tags()->sync($request->tags);
    }

    public function updatePost($request)
    {
        $this->update($request->all());
        $this->tags()->sync($request->tags);
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
}
