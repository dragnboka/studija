<?php

namespace App\Http\Controllers;

use App\Study;
use Illuminate\Http\Request;
use App\Task;
use App\Subject;
use App\Experiment;

class ExperimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subject $subject, Task $task)
    {
        
        $time = implode(":", array($request->sati, $request->minuti));
        $experiment = new Experiment;
        $experiment->subject_id = $subject->id;
        $experiment->task_id = $task->id;
        $experiment->vreme = $time;
        $experiment->komentar = $request->komentar;

        $experiment->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject, Task $task)
    {
        $experiments = Experiment::where([['task_id', $task->id],['subject_id', $subject->id]])->latest()->get();
        
        return view('experiments.show', compact('task','experiments','subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function edit(Study $study)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Study $study)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function destroy(Study $study)
    {
        //
    }
}
