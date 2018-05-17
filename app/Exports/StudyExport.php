<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Study;

class StudyExport implements FromCollection, WithMapping, WithHeadings
{
    private $study;

    public function __construct(Study $study)
    {
        $this->study = $study;
    }

    public function map($subject): array
    {

        return [
            $subject->id,
            $subject->ime,
            $subject->prezime,
            $subject->srednje,
            $subject->rodjen->toDateString(),
            $subject->pol = ($subject->pol == 'm' ? 'muski' : 'zenski'),
            $subject->komentar,
           
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Ime',
            'Prezime',
            'Srednje',
            'Rodjen',
            'Pol',
            'Komentar',  
        ];
    }

    public function collection()
    {
        return $this->study->subjects;
        //return Study::where('id',$this->study->id);
    }
}