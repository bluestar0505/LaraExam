@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {!! Form::model($manageusers, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.manageusers.update', $manageusers->id))) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name*', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::text('name', old('name',$manageusers->name), array('class'=>'form-control')) !!}

        </div>
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email*', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::text('email', old('email',$manageusers->email), array('class'=>'form-control')) !!}

        </div>
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'Role*', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::select('role_id', $role, old('role_id',$manageusers->role_id), array('class'=>'form-control')) !!}

        </div>
    </div>

    <div class="form-group">
        {!! Form::label('paid', 'Paid*', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            <select class="form-control" id="paid" name="paid">
                <option value="">Select</option>
                <option value="1" @if($manageusers->paid == '1')selected="selected" @endif >Yes</option>
                <option value="0" @if($manageusers->paid == '0')selected="selected" @endif>No</option>
            </select>

        </div>
    </div>



    <div class="form-group">
        {!! Form::label('password', 'Password', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::password('password', array('class'=>'form-control')) !!}

        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
            {!! link_to_route(config('quickadmin.route').'.manageusers.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
        </div>
    </div>

    {!! Form::close() !!}

    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            @if(Session::has('success'))
                @if(is_array(session('success')))
                    @foreach(session('success') as $msg)
                        <p class="bg-success">{{$msg}}</p>
                    @endforeach
                @else
                    <p class="bg-success">{{session('success')}}</p>
                @endif
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <h4>Wallet: {{$manageusers->wallet}} tokens</h4>

            <form class="form-inline" method="post" action="{{route('admin:user.give_token')}}">
                {!! csrf_field() !!}
                <input type="text" name="user_id" value="{{$manageusers->id}}" hidden>
                <div class="form-group">
                    <label for="tokens_amount">Give more free tokens: &nbsp;</label>
                    <input type="number" class="form-control" id="tokens_amount" name="amount" step="1"
                           {{--min="0"--}}
                           placeholder="amount"
                           required>
                </div>
                <button type="submit" class="btn btn-primary">Give</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <h4>Give free paper</h4>

            <form class="form-inline" method="post" action="{{route('admin:user.give_paper')}}">
                {!! csrf_field() !!}
                <input type="text" name="user_id" value="{{$manageusers->id}}" hidden>
                <div class="form-group">
                    <label for="tokens_amount">Give more free tokens: &nbsp;</label>
                    <select class="form-control" id="tokens_amount" name="paper_id">
                        @foreach($papers as $paper)
                            <option value="{{$paper->id}}">{{$paper->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Give</button>
            </form>
        </div>
    </div>
@endsection