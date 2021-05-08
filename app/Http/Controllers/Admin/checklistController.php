<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeChecklistRequest;
use App\Models\checklistGroup;
use App\Models\checklist;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class checklistController extends Controller
{
    public function create(checklistGroup $checklistGroup): View
    {
        return view('Admin.checklists.create', compact('checklistGroup'));
    }

    public function store(storeChecklistRequest $request, checklistGroup $checklistGroup): RedirectResponse
    {
        $checklistGroup->checklists()->create($request->validated());
        session()->flash('msg', 'Checklist has been successfully added');
        return redirect()->route('home');
    }

    public function edit(checklistGroup $checklistGroup, checklist $checklist): View
    {
        return view('Admin.checklists.edit', compact('checklistGroup', 'checklist'));
    }

    public function update(storeChecklistRequest $request, checklistGroup $checklistGroup, checklist $checklist): RedirectResponse
    {
        $checklist->update($request->validated());
        session()->flash('msg', 'Checklist has been successfully edited');
        return redirect()->route('home');
    }

    public function destroy(checklistGroup $checklistGroup, checklist $checklist): RedirectResponse
    {
        session()->flash('msg', $checklistGroup->name . ' has beem successfully deleted');
        $checklist->delete();
        return redirect()->route('home');
    }
}
