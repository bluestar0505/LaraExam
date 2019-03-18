@extends('layouts.app')

@section('content')


    <div class="container" style="min-height: 90%;">

    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            <h2>&nbsp;{{ _t('text-nav-profile') }}</h2>

             @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                    </ul>
                </div>
            @endif

            @if(Session::has('profile'))
                <div class="alert alert-success">{{ _t('text-changes-saved') }}</div>
            @endif
        </div>
    </div>

    <form class="form-horizontal" action="{{ route('profile.store') }}" method="POST">
        {{ csrf_field() }}


        <div class="form-group">
            <label class="col-sm-3 control-label">{{ _t('placeholder-name') }}</label>
            <div class="col-sm-9">
                <input class="form-control" type="text" name="name" value="{{ old('name', $profile->name) }}" >
            </div>
        </div>

        <div class="col-sm-9 col-sm-offset-3">
            <h2>Change password</h2>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Old password</label>
            <div class="col-sm-9">
                <input class="form-control" type="password" name="old_password" value="" >
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">New Password</label>
            <div class="col-sm-9">
                <input class="form-control" type="password" name="password" value="" >
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">{{ _t('placeholder-confirm-password') }}</label>
            <div class="col-sm-9">
                <input class="form-control" type="password" name="password_confirmation" value="" >
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <input class="btn btn-primary" value="Update" type="submit">
                <a class="btn btn-default" href="{{ route('web.index') }}">{{ _t('button-cancel') }}</a>
            </div>
        </div>

    </form>

    </div>

@endsection
