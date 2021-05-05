<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeChecklistRequest;
use App\Models\checklistGroup;
use App\Models\checklist;
use Illuminate\Http\Request;

class checklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(checklistGroup $checklistGroup)
    {
        return view('Admin.checklists.create',compact('checklistGroup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  storeChecklistRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeChecklistRequest $request, checklistGroup $checklistGroup)
    {
        $checklistGroup->checklists()->create($request->validated());
        session()->flash('msg','Checklist has been successfully added');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(checklistGroup $checklistGroup, checklist $checklist)
    { 
        return view('Admin.checklists.edit',compact('checklistGroup','checklist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storeChecklistRequest $request,checklistGroup $checklistGroup, checklist $checklist)
    {
        $checklist->update($request->validated());
        session()->flash('msg','Checklist has been successfully edited');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(checklistGroup $checklistGroup, checklist $checklist)
    {
        session()->flash('msg', $checklistGroup->name .' has beem successfully deleted');
        $checklist->delete();
        return redirect()->route('home');
    }
}
