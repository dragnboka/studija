<?php

namespace App\Http\Controllers;

use App\Group;
use App\Study;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Study::with('groups')->get();
       
    }

    public function show(Subject $subject)
    {
        //studije u kojima je subject
        $studiesIds = DB::table('studies')
            ->join('study_subject', 'studies.id', '=', 'study_subject.study_id')
            ->join('subjects', 'study_subject.subject_id', '=', 'subjects.id')
            ->selectRaw('studies.id  as studyId')
            ->where('subjects.id', $subject->id)
            ->get();
        
        //samo id da uzmemo
        $ids=[];
        foreach ($studiesIds as $key => $value) {
            array_push($ids,$value->studyId);
        }
        
        return Study::with('groups')->whereNotIn('id', $ids)->get();
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $subjects = Subject::where(\DB::raw('concat(ime," ",prezime)') , 'LIKE' , "%$query%")
            ->orWhere(\DB::raw('concat(prezime," ",ime)') , 'LIKE' , "%$query%")
            ->orWhere('srednje', 'like',"%$query%")
            ->get();

        $studies = Study::withCount('subjects')->where('name', 'like',"%$query%")->get();

        return response()->json(['subjects'=>$subjects,'studies'=>$studies]);
    }
}
