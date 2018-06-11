<?php

namespace App\Http\Controllers;

use App\{Study, Task, Subject, Experiment};
use Illuminate\Http\Request;
use App\Http\Requests\Experiments\SaveNewExperimentRequest;

class ExperimentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveNewExperimentRequest $request, Subject $subject, Task $task)
    {
        if(!$this->tasksIds($subject)->contains($task->id)){
            abort(404);
        };
        $subject = Subject::findOrFail($subject->id);
        $task = Task::findOrFail($task->id);
        
        $time = implode(":", array($request->hour, $request->minute));
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
        $task->subject()->sync([$subject->id => ['komentar' => $request->task_komentar]]);
        
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
        
        $tasks = $task->study->tasks()->where('id', '<>', $task->id)->get();

        return view('experiments.show', compact('task','experiments','subject','komentar', 'tasks'));
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
