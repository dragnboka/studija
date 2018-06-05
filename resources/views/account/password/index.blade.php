@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('password.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="password_current" class="control-label">Current password</label>
                    <input type="password" name="password_current" id="password_current" class="form-control{{ $errors->has('password_current') ? ' is-invalid' : '' }}">

                    @if ($errors->has('password_current'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_current') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">New password</label>
                    <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="control-label">New password again</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Change password</button>
            </form>
        </div>
    </div>
@endsection
