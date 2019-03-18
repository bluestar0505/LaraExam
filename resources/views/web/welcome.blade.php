@extends('layouts.app', ['bodyClass' => 'main_page'])

@section('content')
    <div class="content_bcg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <div class="home-welcome-container">
                        <h1 class="home-welcome-title">Welcome to <span class="c-dark-blue">Exam</span><span
                                    class="c-light-blue">Hack</span></h1>
                        <h2 class="home-welcome-subtitle">The smart way to study</h2>
                        <div class="home-bar-container">
                            <ul>
                                <li><i class="fa fa-filter" style="top: 23px;left: 30px;font-size: 40px;"></i>We filter for accuracy by calculating everything twice!</li>
                                <li><i class="fa fa-pie-chart" style="top: 23px;left: 30px;font-size: 40px;"></i>Our top class research team break our essays down into bite-size chunks!</li>
                                <li style="background-color:#7ac3ec;"><i class="fa fa-flag fa-lg" style="top: 29px;left: 30px;font-size: 40px;" aria-hidden="true"></i>Our team of bilingual experts solve all of our language exams!
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    @include('web.parts.register2')
                </div>
            </div>
        </div>
    </div>
@endsection
