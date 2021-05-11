<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class pageController extends Controller
{
    public function welcome()
    {
        $page = Page::findOrFail(1);
        return view('page',compact('page'));
    }
    public function consultation()
    {
        $page = Page::findOrFail(2);
        return view('page',compact('page'));
    }
}
