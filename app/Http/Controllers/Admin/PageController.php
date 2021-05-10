<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\updatePagesRequest;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function edit(Page $page): View
    {
        return view('Admin.page.edit',compact('page'));
    }

    public function update(updatePagesRequest $request, Page $page): RedirectResponse
    {
        $page->update($request->validated());
        session()->flash('msg','Page has been successfully updated');
        return redirect()->route('admin.pages.edit',$page);
    }
}
