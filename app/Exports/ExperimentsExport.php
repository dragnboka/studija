<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\{Subject, Study};

class ExperimentsExport implements FromCollection, WithMapping, WithHeadings
{
    private $study;

    private $subject;

    public function __construct(Study $study, Subject $subject)
    {
        $this->study = $study;
        $this->subject = $subject;
        
    }

    public function map($experiment): array
    {
    
        return [
            $experiment->radio,
            //Carbon::createFromTimeString($vreme)->format('H:i');
            $experiment->time($experiment->vreme),
            $experiment->komentar,
            $experiment->task->name,
            $experiment->task->subject()->where('subject_id', $this->subject->id)->first() ? $experiment->task->subject()->where('subject_id', $this->subject->id)->first()->pivot->komentar : '',
        ];

    }

    public function headings(): array
    {
        return [
            'Done by',
            'Time',
            'Comment',
            'Task name',
            'Task comment' 
        ];
    }

    public function collection()
    {
        return $this->study->experiments()->where('subject_id', $this->subject->id)->get();
    }
}