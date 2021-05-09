<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(): View
    {
        //
    }

    public function create(): View
    {
        //
    }

    public function store(Request $request): RedirectResponse
    {
        //
    }

    public function show(Page $page): View
    {
        //
    }

    public function edit(Page $page): View
    {
        //
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        //
    }

    public function destroy(Page $page): RedirectResponse
    {
        //
    }
}
