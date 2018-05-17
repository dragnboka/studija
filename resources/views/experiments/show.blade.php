@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{$task->name}}</h2>
    <div class="row">
        <div class="col-lg-5 order-lg-12 mb-4">
            <form action="{{route('experiment.store', [$subject,$task])}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="sati" class="col-sm-3 col-form-label">Sat</label>
                            <div class="col-sm-9">
                                <input id="sati" type="number" class="form-control" name="sati" min="0" max="23">
                            </div>
                        </div>  
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="minuti" class="col-sm-3 col-form-label">Minut</label>
                            <div class="col-sm-9">
                                <input id="minuti" type="number" class="form-control" name="minuti" min="0" max="59">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="komentar" class="col-form-label">Komentar</label>
                    <textarea name="komentar" class="form-control" id="komentar" cols="30" rows="3"></textarea>
                </div>

                <input class="btn btn-primary" type="submit" value="Savuvaj">
            </form>
        </div>

        <div class="col-lg-7 order-lg-1">
            @if (count($experiments))    
            <table class="table">
                <thead>
                    <tr class="table-success">
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
            @else
                <h3>Nema merenja za ovaj Task</h3>
            @endif
                {{-- <p>{{$experiment->created_at->diffForHumans()}}</p>    --}}
        </div>
    </div>
</div>
@endsection
