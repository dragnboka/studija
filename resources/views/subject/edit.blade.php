@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                    aria-selected="true">Promeni Postojece Informacije</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                    aria-selected="false">Dodaj Ispitanika novoj studiji</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form action="{{route('subject.update', $subject)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Ime</label>

                        <input id="name" type="text" class="form-control" name="ime" value="{{$subject->ime}}" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="prezime" class="col-form-label">Prezime</label>

                        <input id="prezime" type="text" class="form-control" name="prezime"  value="{{$subject->prezime}}">
                    </div>

                    <div class="form-group">
                        <label for="srname" class="col-form-label">Srednje Ime</label>

                        <input id="srname" type="text" class="form-control" name="srednje" value="{{$subject->srednje}}">
                    </div>

                    <div class="mb-2">
                        <p class="mb-2">Pol</p>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="pol" class="custom-control-input" type="radio" id="muski" value="m" {{$subject->pol ==='m' ? 'checked' : ' '}}>
                            <label class="custom-control-label" for="muski">
                                Muski
                            </label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="pol" class="custom-control-input" type="radio" id="zenski" value="z" {{$subject->pol ==='f' ? 'checked' : ' '}}>
                            <label class="custom-control-label" for="zenski">
                                Zenski
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="komentar">Komentar</label>
                        <textarea class="form-control" id="komentar" rows="3" name="komentar">{{$subject->komentar}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary my-5">
                        Edit
                    </button>
                </form>
            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form action="{{route('subject.update', $subject)}}" method="POST">
                    @method('PUT')
                    @csrf
                <update-subject :id={{$subject->id}}></update-subject>
                </form>
            </div>            
        </div>    
    </div>
</div>
@endsection