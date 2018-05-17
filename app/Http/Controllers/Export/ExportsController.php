<?php

namespace App\Http\Controllers\Export;

use App\Study;
use App\Exports\StudyExport;
use App\Exports\SubjectsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportsController extends Controller
{
    public function exportSubjects() 
    {
        return Excel::download(new SubjectsExport, 'invoices.xlsx');
        //return Excel::download(new SubjectsExport, 'invoices.csv');
    }

    public function exportStudy(Study $study) 
    {
        return Excel::download(new StudyExport($study), 'invoices.xlsx');
    }
   
}
