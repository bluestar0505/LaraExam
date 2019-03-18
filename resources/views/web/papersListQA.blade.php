@extends('layouts.app')

@section('content')


    <div class="container">



        <div class="panel panel-pale">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <strong>{{ $category->name }}</strong>
                </h3>
            </div>
            <div class="panel-body">
                @if(isset($papers) && $papers->count() > 0)
                    <ul class="">
                        @foreach($papers as $p)
                            <li class="">
                                <a href="{{ route('paperQA.show', ['id' => $p->id]) }}">{{ $p->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div>{{ _t('text-no-papers-in-category') }}</div>
                @endif
            </div>
        </div>

    </div>




@endsection
