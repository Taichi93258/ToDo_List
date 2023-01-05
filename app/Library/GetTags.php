<?php

namespace App\Library;

use App\Models\Tag;

class GetTags
{
    public function get_tags()
    {
        return Tag::all();
    }
}
