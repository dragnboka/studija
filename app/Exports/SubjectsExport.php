<?php

namespace App\Exports;

use App\Subject;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubjectsExport implements FromCollection, WithMapping
{
     /**
    * @var Invoice $invoice
    */
    public function map($subject): array
    {
        $studijeArray = [];
        
        foreach($subject->studies as $study){
            array_push($studijeArray,$study->name);
        }
        $studije = implode(",", $studijeArray);

        $groupArray = [];
        foreach($subject->groups as $group){
            array_push($groupArray,$group->name);
        }
        $groups = implode(",", $groupArray);
        
        $map =  [
            $subject->id,
            $subject->ime,
            $subject->prezime,
            $subject->srednje,
            $subject->rodjen->toDateString(),
            $subject->pol = ($subject->pol == 'm' ? 'muski' : 'zenski'),
            // $studije,
            // $groups,
            $subject->komentar,
           
        ];
        return array_merge($map,$studijeArray);
    }

    // public function headings(): array
    // {
    //     return [
    //         'ID',
    //         'Ime',
    //         'Prezime',
    //         'Srednje',
    //         'Rodjen',
    //         'Pol',
    //         'Studije',
    //         'Grupe', 
    //         'Komentar',
            
    //     ];
    // }

    public function collection()
    {
        return Subject::all();
    }
}