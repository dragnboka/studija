<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Filters\Study\SubjectFilters;
use App\{Task, Group, Study, Subject, Experiment};
use App\Http\Requests\Subjects\SubjectStoreRequest;

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
    public function create()
    {
        return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectStoreRequest $request)
    {
        $subject = new Subject;
        $subject->ime = $request->firstName;
        $subject->prezime = $request->lastName;
        $subject->srednje = $request->middleName;
        $subject->rodjen = $request->dob;
        $subject->pol = $request->gender == 'm' ? 'm' : 'f';
        $subject->komentar = $request->comment;
        $subject->save();
           
        $ids = array_keys(array_filter($request->studies));
        
        $subject->studies()->attach($ids);

        $subject->groups()->attach($request->groups);

        $request->session()->flash('flash', "$subject->ime was added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject, Request $request)
    {
    
        $experiments = $subject->experiments()->with('task')->filter($request)->paginate(10);
    
        $studyGroups = DB::table('subjects')
            ->join('group_subject', 'subjects.id', '=', 'group_subject.subject_id')
            ->join('groups', 'group_subject.group_id', '=', 'groups.id')
            ->join('studies', 'groups.study_id', '=', 'studies.id')
            ->selectRaw('studies.name  as studyName')
            ->selectRaw('studies.id as id')
            ->selectRaw('groups.name  as groupName')
            ->where('subjects.id', $subject->id)
            ->get();

        $subject = $subject->where('id',$subject->id)->with('studies.tasks')->first();
        
        return view('subject.show', compact('subject','experiments','studyGroups'));
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
    public function update(Request $request, Subject $subject)
    {
        $this->authorize('admin');

        if($request->has('ime')){
            $subject->ime = $request->ime;
            $subject->prezime = $request->prezime;
            $subject->srednje = $request->srednje;
            $subject->pol = $request->pol == 'm' ? 'm' : 'f';
            $subject->komentar = $request->komentar;
            $subject->save();
        } else {

            $ids = array_values(array_filter($request->studije));

            $subject->studies()->attach($ids);
        
            $subject->groups()->attach($request->grupe);
        }
        
        return redirect()->route('subject.show',$subject->id)->with('flash', 'Profile info has been changed.');
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
