@extends('layouts.app')

@section('title',"$study->name study")

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-sm-7">
            <h2 class="flex-grow-1">Study name: {{$study->name}}</h2>
        </div>
        <div class="col-sm-5">
            @can('admin')
            <div class="d-flex justify-content-around">
                <a class="btn btn-outline-primary" href="{{route('study.edit', $study)}}">Edit study</a>
               
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">
                    Delete study
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete study {{$study->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-footer">
                            <form action="{{route('study.destroy', $study)}}" method="POST">
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
           
    <div class="row mb-4">
        
        <div class="col-md-7">
            <table class="table table-bordered">
                <tr class="thead-dark">
                    <th class="w-60">
                        <div class="d-flex">
                            <span>Groups</span> 
                            @if(request('group'))
                            <a href="{{ route('study.show', $study) }}" class="btn btn-danger btn-sm ml-auto">X</a>
                            @endif
                        </div>
                    </th>
                    <th class="w-40">Add new subject to study</th>
                </tr>
                @foreach ($study->groups as $group)
                <tr>
                    <td class="p-0 w-60 table-hover">
                        <a class="d-flex p-3 {{request()->query('group') == $group->name ? 'active-group' : ''}}" href="/study/{{$study->slug}}?group={{urlencode($group->name)}}">{{$group->name}}<span class="badge badge-pill badge-danger p-2 ml-auto">{{$group->subjects->count()}}</span>
                        </a>
                    </td>
                    <td class="p-0 w-40 text-center align-middle"><a class="btn btn-success w-50 p-2" href="{{ route('subject.create', [$study,$group]) }}">Add</a></td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-5">
            <table class="table table-bordered">
                <tr class="thead-dark text-center">
                    <th>Tasks</th>
                </tr>
                @foreach ($study->tasks as $task)
                <tr>
                    <td class="text-center align-middle">{{$task->name}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    @if(count($subjects))
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-md-center mb-3">Study subjects</h2>
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
                    <div class="table-cell">{{$subject->ime}}</div>
                    <div class="table-cell">{{$subject->prezime}}</div>
                    <div class="table-cell">{{$subject->srednje}}</div>
                    <div class="table-cell">{{$subject->rodjen->toFormattedDateString()}}</div>
                    <div class="table-cell">{{$subject->pol == 'm' ? 'male' : 'female'}}</div>
                </a>
                @endforeach
            </div>    
        </div>
    </div>
    @else
        @if(request('group'))
            <h3 class="text-center">No subjects for searched group {{request('group')}}
                <a href="{{ route('study.show', $study) }}" class="btn btn-danger btn-sm ml-auto">clear filter X</a>
            </h3>
        @else
        <h3>No subjects for {{$study->name}} study</h3>
        @endif 
    @endif
</div>
@endsection


