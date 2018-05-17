@extends('layouts.app')

@section('content')

<div class="container">
@if($subjects->count())
        <h2 class="mb-3 text-md-center">{{$subjects->total()}} {{ ngettext(" Ispitanik", "Ispitanika", $subjects->total())}} za trazeni search {{request()->input('query')}}</h2>

        <div class="table table1 table-responsive">
            <a class="table-row table-row-headig">
                <div class="table-cell">Id</div>
                <div class="table-cell">Ime</div>
                <div class="table-cell">Prezime</div>
                <div class="table-cell">Srednje ime</div>
                <div class="table-cell">Rodjen/a</div>
                <div class="table-cell">Pol</div>
            </a>
            @foreach ($subjects as $subject)
            <a class="table-row table-row-body" href="{{route('subject.show', $subject)}}">
                <div class="table-cell">{{$subject->id}}</div>
                <div class="table-cell">{{$subject->formattedName}}</div>
                <div class="table-cell">{{$subject->prezime}}</div>
                <div class="table-cell">{{$subject->srednje}}</div>
                <div class="table-cell">{{$subject->rodjen->toFormattedDateString()}}</div>
                <div class="table-cell">{{$subject->pol == 'm' ? 'muski' : 'zenski'}}</div>
            </a>
            @endforeach
        </div>    
        {{ $subjects->links() }}
    @else
        nema takvog
    @endif

    @if($studies->count())
        <h2 class="mb-3 text-md-center">{{$studies->total()}} {{ ngettext(" Studija", "Studije", $studies->total())}} za trazeni search {{request()->input('query')}}</h2>

        <div class="table table1 table-responsive">
            <a class="table-row table-row-headig">
                <div class="table-cell">Id</div>
                <div class="table-cell">Ime</div>
                <div class="table-cell">Datum</div>
                <div class="table-cell">Broj Ucesnika</div>
            </a>
            @foreach ($studies as $study)
            <a class="table-row table-row-body" href="{{route('study.show', $study)}}">
                <div class="table-cell">{{$study->id}}</div>
                <div class="table-cell">{{$study->name}}</div>
                <div class="table-cell">{{$study->created_at->toFormattedDateString()}}</div>
                <div class="table-cell">{{$study->subjects_count}}</div>
                
            </a>
            @endforeach
        </div>    
        {{ $studies->links() }}
    @else
        
    @endif
@endsection
</div>