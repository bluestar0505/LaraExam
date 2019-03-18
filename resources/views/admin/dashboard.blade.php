@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-md-2">
            <h2>User activity</h2>
            <?php $activity = \App\User::activity();?>

            @if($activity)
                <table>
                    @foreach($activity as $k=>$v)
                        <tr>
                            <td class="col-xs-2">{{ $k }}</td>
                            <td class="col-xs-2">{{ $v }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
        <div class="col-xs-12 col-md-5">
            <h2>Default tabs</h2>
            <div id="default_tab_piechart"></div>
        </div>
        <div class="col-xs-12 col-md-5">
            <h2>Paid users</h2>
            <div id="paid_users_pichart"></div>
        </div>
        {{--<div class="col-xs-12 col-md-3">--}}
            {{--<h2>10 Latest success payments</h2>--}}
            {{--<div class="table-responsive">--}}
                {{--<table class="table table-condensed">--}}
                    {{--<tr>--}}
                        {{--<th>ID</th>--}}
                        {{--<th>User email</th>--}}
                        {{--<th>Amount</th>--}}
                        {{--<th>Date</th>--}}
                    {{--</tr>--}}
                    {{--@foreach($latestPayments as $payment)--}}
                        {{--<tr>--}}
                            {{--<td>{{ $payment->id }}</td>--}}
                            {{--<td>{{ $payment->user->email }}</td>--}}
                            {{--<td>{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</td>--}}
                            {{--<td>{{ $payment->updated_at }}</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}

    </div>

@endsection

@section('javascript')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Default tab', 'Total'],
                    @foreach($usersDefaultTab as $key => $value)
                ['{{$key ? $key : 'None'}}', {{(int)$value}}],
                @endforeach
            ]);

            var options = {
                legend: 'labeled',
            };

            var chart = new google.visualization.PieChart(document.getElementById('default_tab_piechart'));
            chart.draw(data, options);
        }
        google.charts.setOnLoadCallback(drawChartPaid);
        function drawChartPaid() {
            var data = google.visualization.arrayToDataTable([
                ['Type', 'count'],
                @foreach($usersPaid as $key => $value)
                    ['{{$key ? 'Paid' : 'Unpaid'}}', {{(int)$value}}],
                @endforeach
            ]);

            var options = {
                legend: 'bottom'
            };

            var chart = new google.visualization.PieChart(document.getElementById('paid_users_pichart'));
            chart.draw(data, options);
        }
    </script>
@endsection