@extends('admin.layouts.master')

@section('content')

    @include('admin.partials.title')



@if ($suggestions->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        <th>
                            User Name
                        </th>
                        <th>Comment</th>
                        <th>Date Created</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($suggestions as $row)
                        <tr>
                           
                            <td>{{ $row->UserName }}</td>
                           
                            <td>{{ $row->Sugesstion }}</td>
                            <td>{{ $row->DateCreated }}</td>
                             <td>   

                             <input class="btn btn-xs btn-danger" type="button" value="Delete"  onclick="deletesuggestion({{ $row->ID }})">

                             </td>
                         
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
	</div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

@section('javascript')
   
@stop