@extends('account.layouts.default')

@section('account.content')
<div class="row">
    <div class="col-sm-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="POST">
                    @csrf
        
                    <div class="form-group">
                        <label for="ime" class="col-form-label">{{ __('First name') }}</label>
        
                        <input id="ime" type="text" class="form-control{{ $errors->has('ime') ? ' is-invalid' : '' }}" name="ime" value="{{ old('ime', auth()->user()->ime) }}" required autofocus>
        
                        @if ($errors->has('ime'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('ime') }}</strong>
                            </span>
                        @endif
                        
                    </div>
        
                    <div class="form-group">
                        <label for="prezime" class="col-form-label">{{ __('Last name') }}</label>
        
                        <input id="prezime" type="text" class="form-control{{ $errors->has('prezime') ? ' is-invalid' : '' }}" name="prezime" value="{{ old('prezime', auth()->user()->prezime) }}" required autofocus>
        
                        @if ($errors->has('prezime'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('prezime') }}</strong>
                            </span>
                        @endif
                        
                    </div>
        
                    <div class="form-group">
                        <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
        
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', auth()->user()->email) }}" required autofocus>
        
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
        
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
