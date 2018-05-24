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
        $experiment->radio = auth()->user()->fullName;
        $experiment->vreme = $time;
        $experiment->komentar = $request->komentar;

        $experiment->save();

        return redirect()->back();
    }

    public function storeComment(Request $request, Subject $subject, Task $task)
    {
        $task->subject()->attach($subject, ['komentar' => $request->task_komentar]);
        
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
        $komentar = $task->subject()->where('subject_id', $subject->id)->first();
        
        $experiments = Experiment::where([['task_id', $task->id],['subject_id', $subject->id]])->get();
        
        return view('experiments.show', compact('task','experiments','subject','komentar'));
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
