<?php

namespace App\Http\Controllers;

use App\Study;
use App\Subject;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $subjects = Subject::where(\DB::raw('concat(ime," ",prezime)') , 'LIKE' , "%$query%")
            ->orWhere('srednje', 'like',"%$query%")
            ->paginate(30);
        
        // $subjects = Subject::where('ime', 'like',"%$query%")
        // ->orWhere('prezime', 'like',"%$query%")
        // ->orWhere('srednje', 'like',"%$query%")
        // ->paginate(50);
       
        $studies = Study::withCount('subjects')->where('name', 'like',"%$query%")->paginate(50);

        return view('search.index', compact('subjects', 'studies'));
    }
}
