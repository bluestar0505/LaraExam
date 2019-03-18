@extends('admin.layouts.master')

@section('content')

    @include('admin.partials.title')

 <p>

<a class='btn btn-success' href="{{ route('notify.create') }}">   Add New </a>
</p>


@if ($notify->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                       
                        <th>Notification</th>
                        <th>Date Created</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($notify as $row)
                        <tr>
                           
                          
                           
                            <td>{{ $row->notify_text }}</td>
                            <td>{{ $row->DateCreated }}</td>
                             <td>   

                             <input class="btn btn-xs btn-danger" type="button" value="Delete"  onclick="deletenotification({{ $row->ID }})">

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
    <script>
        $(document).ready(function () {
                   
         });
    </script>
@stop