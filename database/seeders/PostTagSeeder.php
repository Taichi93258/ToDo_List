<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < Post::count(); $i++) {
            $set_post_id = Post::select('id')->orderByRaw("RAND()")->first()->id;
            $set_tag_id = Tag::select('id')->orderByRaw("RAND()")->first()->id;

            $post_tag = DB::table('post_tag')
                            ->where([
                                ['post_id', '=', $set_post_id],
                                ['tag_id', '=', $set_tag_id]
                            ])->get();

            if ($post_tag->isEmpty()) {
                DB::table('post_tag')->insert(
                    [
                        'post_id' => $set_post_id,
                        'tag_id' => $set_tag_id,
                    ]
                );
            } else {
                $i--;
            }
        }
    }
}