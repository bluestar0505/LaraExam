@extends('admin.layouts.master')

@section('content')

    @include('admin.partials.title')

    <p>{!! link_to_route(config('quickadmin.route').'.manageusers.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

    @if ($manageusers->count())
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                    <thead>
                    <tr>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Wallet</th>
                        <th>Total spent</th>
                        {{--<th>Role</th>--}}

                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($manageusers as $row)
                        <tr>

                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->wallet }}</td>
                            <td>{{ $row->amountSpent() }}</td>
                            {{--                            <td>{{ isset($row->role->) ? $row->role-> : '' }}</td>--}}

                            <td>
                                {!! link_to_route(config('quickadmin.route').'.manageusers.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.manageusers.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>

                                @if($row->paid == 1)

                                    <div style="font-size: 18px"><!-- pretend an enclosing class has big font size -->
                                        <span class="label label-success label-as-badge">Paid</span>
                                    </div>                  @elseif ($row->paid != 1)

                                    <div style="font-size: 18px"><!-- pretend an enclosing class has big font size -->
                                        <span class="label label-danger label-as-badge">UnPaid</span>
                                    </div>

                                @endif
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
