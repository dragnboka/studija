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
            $experiment->task->subject()->where('subject_id', $this->subject->id)->first() ? $experiment->task->subject()->where('subject_id', $this->subject->id)->first()->pivot->komentar : '',
        ];

    }

    public function headings(): array
    {
        return [
            'Radio',
            'Vreme',
            'Komentar',
            'ime taska',
            'task komentar' 
        ];
    }

    public function collection()
    {
        return $this->subject->experiments;
    }
}