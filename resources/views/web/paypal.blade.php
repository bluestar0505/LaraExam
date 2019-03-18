@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0">
                <div class="front-image asd" style="margin-top: 50px"></div>
            </div>
            <div class="col-md-6">
                @include('web.parts.paypal')
            </div>
        </div>
    </div>




@endsection
