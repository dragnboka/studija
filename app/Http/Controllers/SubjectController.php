<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Filters\Study\SubjectFilters;
use App\{Task, Group, Study, Subject, Experiment};
use App\Http\Requests\Subjects\{
    SubjectStoreRequest,
    UpdateSubjectInfoRequest,
    AddStudyToSubjectRequest
    };

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mappings = SubjectFilters::mappings();
        
        $subjects = Subject::filter($request)->paginate(50);
        
        return view('subject.index', compact('subjects','mappings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Study $study, Group $group)
    {
        return view('subject.create', compact('study', 'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectStoreRequest $request, Study $study, Group $group)
    {
        $subject = new Subject;
        $subject->ime = $request->firstName;
        $subject->prezime = $request->lastName;
        $subject->srednje = $request->middleName;
        $subject->rodjen = $request->dob;
        $subject->pol = $request->gender;
        $subject->komentar = $request->comment;
        $subject->save();
        
        $subject->studies()->attach($study->id);

        $subject->groups()->attach($group->id);

        return redirect()->route('subject.show',$subject->id)->with('flash', "$subject->ime was added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject, Request $request)
    {
        $studyGroups = DB::table('subjects')
            ->join('group_subject', 'subjects.id', '=', 'group_subject.subject_id')
            ->join('groups', 'group_subject.group_id', '=', 'groups.id')
            ->join('studies', 'groups.study_id', '=', 'studies.id')
            ->selectRaw('studies.name  as studyName')
            ->selectRaw('studies.id as id')
            ->selectRaw('groups.name  as groupName')
            ->where('subjects.id', $subject->id)
            ->where('studies.deleted_at', null)
            ->get();

        $experiments = $subject->experiments()->with('task')->filter($request)->paginate(10);
        
        $subject = $subject->where('id',$subject->id)->with('studies.tasks')->first();
        
        return view('subject.show', compact('subject','experiments','studyGroups'));
    }

    public function showCreate(Request $request, Study $study, Group $group)
    {
        $subjects = Subject::whereDoesntHave('studies', function ($query) use ($study)  {
            $query->where('studies.id', $study->id);
        })->get();
        
        return view('study.subjects.index', compact('subjects','study','group'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $this->authorize('admin');
        
        return view('subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectInfoRequest $request, Subject $subject)
    {
        $this->authorize('admin');
        
        $subject->ime = $request->firstName;
        $subject->prezime = $request->lastName;
        $subject->srednje = $request->middleName;
        $subject->pol = $request->gender;
        $subject->komentar = $request->komentar;
        $subject->save();
        
        return redirect()->route('subject.show',$subject->id)->with('flash', 'Profile info has been changed.');
    }
    
    public function addStudy(AddStudyToSubjectRequest $request, Subject $subject)
    {
        //$ids = array_values(array_filter($request->studies));
        
        $subject->studies()->attach($request->studies);
    
        $subject->groups()->attach($request->groups);
        
        $request->session()->flash('flash', "$subject->ime was added to new study");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $this->authorize('admin');

        $subject->delete();
        $subject->experiments()->delete();
        return redirect()->route('subject.index')->with('flash', 'Subject was deleted.');
    }
}
