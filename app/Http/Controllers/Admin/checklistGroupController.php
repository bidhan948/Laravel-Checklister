<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\checklistGroupStoreRequest;
use App\Models\checklistGroup;

class checklistGroupController extends Controller
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
    public function create()
    {
        return view('Admin.checklist_groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(checklistGroupStoreRequest  $request)
    {
        checklistGroup::create($request->validated());
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
     * @param  checklistGroup $checklistGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(checklistGroup $checklistGroup)
    {
        return view('Admin.checklist_groups.edit',compact('checklistGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\checklistGroupStoreRequest $request
     * @param  checklistGroup $checklistGroup
     * @return \Illuminate\Http\Response
     */
    public function update(checklistGroupStoreRequest $request, checklistGroup $checklistGroup)
    {
        $checklistGroup->update($request->validated());
        session()->flash('msg','Checklist group has been successfully edited');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  checklistGroup $checklistGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(checklistGroup $checklistGroup)
    {
        session()->flash('msg', $checklistGroup->name .' has beem successfully deleted');
        $checklistGroup->delete();
        return redirect()->route('home');
    }
}
