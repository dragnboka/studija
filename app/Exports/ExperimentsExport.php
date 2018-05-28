<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Subject;

class ExperimentsExport implements FromCollection, WithMapping, WithHeadings
{
    private $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function map($experiment): array
    {

        return [
            $experiment->radio,
            $experiment->vreme,
            $experiment->komentar,
            $experiment->task->name,
        ];
    }

    public function headings(): array
    {
        return [
            'Radio',
            'Vreme',
            'Komentar',
            'ime taska'  
        ];
    }

    public function collection()
    {
        //dd($this->subject->experiments);
        return $this->subject->experiments;
        //return Study::where('id',$this->study->id);
    }
}