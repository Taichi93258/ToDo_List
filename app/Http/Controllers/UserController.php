<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function release(Request $request, User $user)
    {
        $user->updateUserRelease($request);
        return redirect()->route('posts.index');
    }
}
