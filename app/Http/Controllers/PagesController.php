<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $name = 'John Doe';
        $age = 30;
        return view('welcome', compact('name', 'age'));
    }
}
