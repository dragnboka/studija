@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-6 mb-3">
            <table class="table table-hover">
                <tr class="table-success">
                    <th colspan="2">Podaci o ispitaniku</th>
                </tr>
                <tr>
                    <td>Ime</td>
                    <td>{{$subject->ime}}</td>
                </tr>
                <tr>
                    <td>Prezime</td>
                    <td>{{$subject->prezime}}</td>
                </tr>
                <tr>
                    <td>Srednje Ime</td>
                    <td>{{$subject->srednje}}</td>
                </tr>
                <tr>
                    <td>Datum Rodjenja</td>
                    <td>{{$subject->formattedRodjen}}</td>
                </tr>
                <tr>
                    <td>Pol</td>
                    <td>{{$subject->formattedPol}}</td>
                </tr>
                <tr>
                    <td>Komentar o pacijentu</td>
                    <td>{{$subject->komentar}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-5">
            @if(count($studyGroups))
            <table class="table table-hover">
                <tr class="table-success">
                    <th colspan="2">Studije u kojima ucestvuje</th>
                </tr>
                <tr>
                    <td>Naziv Studije</td>
                    <td>Naziv Grupe</td>
                </tr>
                @foreach ($studyGroups as $study)
                <tr>
                    <td>{{$study->studyName}}</td>
                    <td>{{$study->groupName}}</td>
                </tr>
                @endforeach
            </table>
            @else 
                <h3>Subjekat trenutno nije ni u jednoj studiji</h3>   
            @endif
        </div>
        <div class="col-md-1">
            @can('admin')
            <a class="btn btn-success-my" href="{{route('subject.edit', $subject)}}">Edit</a>
            @endcan
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="text-center">Izberi studiju za novo merenje</h2>
            <div id="accordion">
                @foreach ($subject->studies as $study)
                <div class="card">
                    <div class="card-header p-0" id="heading{{$study->id}}">
                    <h5 class="mb-0 d-flex">
                        <button class="btn flex-grow-1 p-3" data-toggle="collapse" data-target="#{{$study->id}}" aria-expanded="false" aria-controls="collapseOne">
                            Studija: {{$study->name}}
                        </button>
                    </h5>
                    </div>
                
                    <div id="{{$study->id}}" class="collapse" aria-labelledby="heading{{$study->id}}" data-parent="#accordion">
                    <div class="card-body p-0">
                        <ul class="list-group">
                            @foreach ($study->tasks as $task)
                            <li class="list-group-item text-center d-flex">
                                <a class="flex-grow-1" href="{{route('experiment.show', [$subject,$task])}}">Task: {{$task->name}}</a>
                            </li>
                            
                        </ul>
                    @endforeach
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(count($experiments))
            <h2 class="my-3 text-center">Sva Merenja za {{$subject->ime}}</h2>
            <div class="btn-group mb-4">
                <button type="button" class="btn btn-outline-primary btn-square dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{-- {{request()->input($key) ?? $key}} --}}
                    Taskovi
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($subject->studies as $study)
                    @foreach ($study->tasks as $task)
                        <a class="dropdown-item" href="http://127.0.0.1:8000/subject/4?task={{$task->name}}">{{$task->name}}</a>
                    @endforeach
                    @endforeach
                </div> 
            </div>
            {{-- @foreach ($experiments->task as $task)
                {{$task->name}}
            @endforeach --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>Vreme</th>
                        <th>Komentar</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($experiments as $experiment)
                    <tr>
                        <td>{{$experiment->vreme}}</td>
                        <td>{{$experiment->komentar}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $experiments->links() }}
            @else
                <h3 class="text-center">Trenutno nema merenja za {{$subject->ime}}</h3>
            @endif
           
        </div>
    </div>
</div>
@endsection