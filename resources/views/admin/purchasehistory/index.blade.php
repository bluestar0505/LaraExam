@extends('admin.layouts.master')

@section('content')


@if ($purchases->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            User name
                        </th>
                        <th>
                            User email
                        </th>
                        <th>
                            Paper name
                        </th>
                        <th>
                            Paper Selling Price
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($purchases as $row)
                        <tr>
                            <td>
                                {{ $row->id }}
                            </td>
                            <td>
                                {{ $row->userName }}
                            </td>
                            <td>
                                {{ $row->userEmail }}
                            </td>
                            <td>
                                {{ $row->paperName }}
                            </td>
                            <td>
                                {{ $row->amount }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">
                        {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                    </button>
                </div>
            </div>
        </div>
	</div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                    }
                    $('#massDelete').submit();
                }
            });
        });
    </script>
@stop