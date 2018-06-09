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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subject $subject, Task $task)
    {
        if(!$this->tasksIds($subject)->contains($task->id)){
            abort(404);
        };
        
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
        if(!$this->tasksIds($subject)->contains($task->id)){
            abort(404);
        };
        $komentar = $task->subject()->where('subject_id', $subject->id)->first();
        
        $experiments = Experiment::where([['task_id', $task->id],['subject_id', $subject->id]])->get();
        
        return view('experiments.show', compact('task','experiments','subject','komentar'));
    }

    protected function tasksIds(Subject $subject)
    {
        return \DB::table('subjects')
        ->join('study_subject', 'subjects.id', '=', 'study_subject.subject_id')
        ->join('studies', 'study_subject.study_id', '=', 'studies.id')
        ->join('tasks', 'studies.id', '=', 'tasks.study_id')
        ->where('subjects.id', $subject->id)
        ->where('studies.deleted_at', null)
        ->pluck('tasks.id');
    }
}
