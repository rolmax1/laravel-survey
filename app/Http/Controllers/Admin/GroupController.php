<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupForm;
use App\Models\Group;
use App\Models\Survey;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Survey $survey)
    {
        return view('admin.groups.index')
            ->with('survey', $survey)
            ->with('groups', $survey->groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Survey $survey)
    {
        return view('admin.groups.create')
            ->with('survey', $survey)
            ->with('group', new Group);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupForm $request, Survey $survey)
    {
        $survey->groups()->create([
            'slug' => $request->slug,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey, Group $group)
    {
        return view('admin.groups.show')
            ->with('survey', $survey)
            ->with('group', $group)
            ->with('questions', $group->questions->load(['answers']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey, Group $group)
    {
        return view('admin.groups.edit')
            ->with('survey', $survey)
            ->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupForm $request, Survey $survey, Group $group)
    {
        $group->update([
            'slug' => $request->slug,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey, Group $group)
    {
        $group->delete();

        return redirect()->route('admin.surveys.show', [
            $survey->id,
        ]);
    }
}
