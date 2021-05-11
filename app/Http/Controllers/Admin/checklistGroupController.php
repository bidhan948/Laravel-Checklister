<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\checklistGroupStoreRequest;
use App\Http\Requests\updateChecklistGroup;
use App\Models\checklistGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class checklistGroupController extends Controller
{
    public function create():View
    {
        return view('Admin.checklist_groups.create');
    }

    public function store(checklistGroupStoreRequest  $request):RedirectResponse
    {
        checklistGroup::create($request->validated());
        return redirect()->route('welcome');
    }

    public function edit(checklistGroup $checklistGroup): View
    {
        return view('Admin.checklist_groups.edit',compact('checklistGroup'));
    }

    public function update(updateChecklistGroup $request, checklistGroup $checklistGroup):RedirectResponse
    {
        $checklistGroup->update($request->validated());
        session()->flash('msg','Checklist group has been successfully edited');
        return redirect()->route('welcome');
    }

    public function destroy(checklistGroup $checklistGroup):RedirectResponse
    {
        session()->flash('msg', $checklistGroup->name .' has beem successfully deleted');
        $checklistGroup->delete();
        return redirect()->route('welcome');
    }
}
