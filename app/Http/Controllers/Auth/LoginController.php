<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function index()
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        return redirect('todo_list');
    }
}