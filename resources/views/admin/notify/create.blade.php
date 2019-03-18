@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>
<form action="" id="createNotification">
     <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Send to</label>
        <div class="col-sm-10">

            <select id="toto" name="to[]" multiple="multiple">
                <option value="all">Everybody</option>
                @foreach($categories as $key => $category)
                    <option value="{{$key}}">{{$category}}</option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Notification*</label>
        <div class="col-sm-10">

            <textarea name="notify_text" id="notify_text"   class="form-control" required="required"></textarea>

        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
          <input class="btn btn-primary" type="button" value="Create" id="addNotify" style="margin-top:25px;">
        </div>
    </div>
</form>



@endsection
