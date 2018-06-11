<?php

namespace App\Http\Controllers\Export;

use App\Study;
use App\Subject;
use App\Exports\StudyExport;
use App\Exports\SubjectsExport;
use App\Exports\ExperimentsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportsController extends Controller
{
   
    public function exportStudy(Study $study) 
    {
        if(count($study->subjects)) {
            return Excel::download(new StudyExport($study), "$study->name subjects.xlsx");
        } else {
            return back()->withFlash('No data to export');
        }
    }

    public function exportSubjectExperiments(Study $study, Subject $subject) 
    {
        if(count($study->experiments()->where('subject_id', $subject->id)->get())) {
            return Excel::download(new ExperimentsExport($study, $subject), "$subject->fullName $study->name.xlsx");
        } else {
            return back()->withFlash('No data to export');
        }
       
    }
   
}
