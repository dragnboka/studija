@extends('layouts.app')

@section('content')

<div class="container">
    <auto-complete></auto-complete>
    <div class="row mb-2">
        <div class="col-sm-4 d-flex justify-content-center">
            <a class="btn btn-primary" href="{{route('subject.create')}}">Kreiraj novog ispitanika</a>
        </div>
        <div class="col-sm-4 offset-sm-4 d-flex justify-content-center">
            <a class="btn btn-primary" href="{{route('export.subjects')}}">Export all subjects</a>
        </div>
    </div>    
        
    @if($subjects->count())
        <h2 class="mb-3 text-md-center">All subjects</h2>
        <div>
            <div class="d-flex justify-content-around">
                @include('subject.partials._filters') 
            </div>
            @if (count(array_intersect(array_keys(request()->query()), array_keys($mappings))))
                <p class="text-center">
                    <a href="{{ route('subject.index') }}">Clear all filters</a>
                </p>
            @endif
        </div>

        <div class="table table1 table-responsive">
            <a class="table-row table-row-headig">
                <div class="table-cell">Id</div>
                <div class="table-cell">First name</div>
                <div class="table-cell">Last name</div>
                <div class="table-cell">Middle name</div>
                <div class="table-cell">Date of birth</div>
                <div class="table-cell">Gender</div>
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
        {{ $subjects->appends(request()->query())->links() }}
    @else
        Trenutno nema ispitanika
    @endif
     
</div>
@endsection
