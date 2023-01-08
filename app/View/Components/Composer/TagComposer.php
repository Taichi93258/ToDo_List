<?php

namespace App\View\Components\Composer;

use Illuminate\View\View;
use App\Models\Tag;

class TagComposer
{
    public function __construct()
    {
        //
    }
    /**
     * Bind data to the view.
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('tags', Tag::all());
    }
}