<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Task, Group, Study};
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Studies\{UpdateStudyInfoRequest, AddTaskAndGroupsToStudyRequest};
use App\Http\Requests\Studies\CreateStudyRequest;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $studies = Study::withCount('subjects')->get();
        
        return view('study.index', compact('studies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('study.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStudyRequest $request)
    {
        $study = new Study;
        $study->name = $request->name;
        $study->slug = str_slug($request->name, '-');
        $study->save();
        $id = $study->id;
        $s = Study::where('id',$id)->first();
        foreach($request->tasks as $task) {
            $t = new Task;
            $t->name = $task;
            $study->tasks()->save($t);
        }
        foreach($request->groups as $group) {
            $g = new Group;
            $g->name = $group;
            $study->groups()->save($g);
        }
        
        $request->session()->flash('flash', "Study $study->name was created");
    }

    public function storeNew(AddTaskAndGroupsToStudyRequest $request)
    {
    
        $study = Study::where('slug',$request->slug)->firstOrFail();
        
        if (count($request->tasks)) {
            foreach($request->tasks as $task) {
                $t = new Task;
                $t->name = $task;
                $study->tasks()->save($t);
            }
        }
        
        if (count($request->groups)) {
            foreach($request->groups as $group) {
                $g = new Group;
                $g->name = $group;
                $study->groups()->save($g);
            }
        }
        $request->session()->flash('flash', "Successfully added to study");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Study $study)
    {
        $study =  $study->where('id', $study->id)->with(['tasks','subjects','groups','groups.subjects'])->firstOrFail();

        $subjects = $study->subjects()->groupFilter($request)->paginate(50);
    
        return view('study.show', compact('study', 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function edit(Study $study)
    {
        $this->authorize('admin');

        $study =  $study->where('id', $study->id)->with(['tasks','groups'])->firstOrFail();
        return view('study.edit', compact('study'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudyInfoRequest $request, Study $study)
    { 
        $this->authorize('admin');

        $study->name = $request->name;
        $study->slug = str_slug($request->name, '-');
        $study->save();
        $tasks = Task::where('study_id', $study->id)->get();
        foreach ($tasks as $key => $task) {
            $task->name = $request->tasks[$key];
            $task->save();
        }

        $groups = Group::where('study_id', $study->id)->get();
        foreach ($groups as $key => $group) {
            $group->name = $request->groups[$key];
            $group->save();
        }

        return redirect()->route('study.show',$study)->with('flash', 'Study info has been changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function destroy(Study $study)
    {
        $study->delete();
        $study->experiments()->delete();
        return redirect()->route('study.index')->with('flash', 'Study was deleted.');
    }
}
