@extends('layouts.app')

@section('title',"$subject->fullName ")

@section('content')
<div class="container">
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="row mb-3">
        <div class="col-sm-12">
            @can('admin')
            <div class="d-flex justify-content-around">
                <a class="btn btn-success-my w-25" href="{{route('subject.edit', $subject)}}">Edit</a>
                <button type="button" class="btn btn-outline-danger w-25" data-toggle="modal" data-target="#exampleModal">
                    Delete {{$subject->ime}}
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete subject {{$subject->ime}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('subject.destroy', $subject)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Yes</button>
                                </form>
                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <table class="table table-hover">
                <tr class="table-success">
                    <th colspan="2">{{$subject->fullName}} info</th>
                </tr>
                <tr>
                    <td>First name</td>
                    <td>{{$subject->ime}}</td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td>{{$subject->prezime}}</td>
                </tr>
                <tr>
                    <td>Middle name</td>
                    <td>{{$subject->srednje}}</td>
                </tr>
                <tr>
                    <td>Date of birth</td>
                    <td>{{$subject->rodjen->format('d,m,Y')}}</td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td>{{$subject->age}}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{$subject->formattedPol}}</td>
                </tr>
                <tr>
                    <td>Subject comment</td>
                    <td>{{$subject->komentar}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            @if(count($studyGroups))
            <table class="table table-hover">
                <tr class="table-success">
                    <th colspan="2">Studies for {{$subject->fullName}}</th>
                </tr>
                <tr>
                    <td>Study name</td>
                    <td>Group</td>
                </tr>
                @foreach ($studyGroups as $study)
                <tr>
                    <td>
                        <p>{{$study->studyName}}</p>
                        <a class="btn btn-primary" href="{{route('subject.experiments', [$study->slug,$subject])}}">Export subject Experiments</a>
                    </td>
                    <td>{{$study->groupName}}</td>
                </tr>
                @endforeach
            </table>
            @else 
                <h3>Subject is not in any study</h3>   
            @endif
        </div>
    </div>

    @if(count($studyGroups))
        <div class="row my-3">
            <div class="col-md-12">
                <h2 class="text-center mb-3">Select study to add new experiment</h2>
                
                @foreach ($subject->studies as $study)
                    <button type="button" class="btn btn-modal w-50 d-flex mb-2 mx-auto" data-toggle="modal" data-target="#{{$study->id}}">
                        <span class="flex-grow-1">{{$study->name}}</span> <i class="fa fa-plus p-2" aria-hidden="true"></i>

                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="{{$study->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$study->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Choose task to add new experiment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group list-group--task">
                                        @foreach ($study->tasks as $task)
                                        <li class="list-group-item p-0 text-center d-flex">
                                            <a class="flex-grow-1 p-3" href="{{route('experiment.show', [$subject,$task])}}">{{$task->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div> <!--end of Modal -->
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if(count($experiments))
                <h2 class="my-3 text-center">All experiments for {{$subject->ime}}</h2>
                
                <div class="flex mb-4">
                    @foreach ($subject->studies as $study)
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary btn-square dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$study->name}}
                        </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($study->tasks as $task)
                                <a class="dropdown-item" href="/subject/{{$subject->id}}?task={{$task->name}}">{{$task->name}}</a>
                            @endforeach
                        </div> 
                    </div>
                    @endforeach
                    @if(request('task'))
                        <a href="{{ route('subject.show', $subject) }}" class="btn btn-danger btn-sm ml-auto">clear filter X</a>
                    @endif
                </div>   

                <table class="table">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Comment</th>
                            <th>Done by</th>
                            <th>Task</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($experiments as $experiment)
                        <tr>
                            <td>{{$experiment->time($experiment->vreme)}}</td>
                            <td>{{$experiment->komentar}}</td>
                            <td>{{$experiment->radio}}</td>
                            <td>{{$experiment->task->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $experiments->links() }}
                @else
                    @if(request('task'))
                        <h3 class="text-center">No experiments for searched task {{request('task')}}
                            <a href="{{ route('subject.show', $subject) }}" class="btn btn-danger btn-sm ml-auto">clear filter X</a>
                        </h3>
                        
                    @else
                    <h3 class="text-center">No experiments for {{$subject->ime}}</h3>
                    @endif
                @endif
            
            </div>
        </div>
    @endif
</div>
@endsection