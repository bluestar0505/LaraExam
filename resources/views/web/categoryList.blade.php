@extends('layouts.app')

@section('content')



   <div class="container">

        <div class="panel panel-pale">
            <div class="panel-heading">
             
           <a class='btn btn-default active ' href="javascript:void(0)" onclick="updateDefault('jf-engineering','home')" >
                <strong>{{ _t('text-jf-engineering') }}</strong>
            </a>
            
            <a class='btn btn-default ' href="javascript:void(0)" onclick="updateDefault('sf-engineering','SFEngineering')">       
                    <strong>{{ _t('text-sf-engineering') }}</strong>
            </a>
           
             <a class='btn btn-default ' href="javascript:void(0)" onclick="updateDefault('jf-mathematics','JFMathematics')">       
                    <strong>{{ _t('jf-mathematics') }}</strong>
            </a>
            
            </div>
            <div class="panel-body">
                @if(isset($categories) && $categories->count() > 0)
                    <ul class="">
                        @foreach($categories as $c)
                            <li class="">
                                <a href="{{ route('category.show', ['id' => $c->id]) }}">{{ $c->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                @else
                    <div>{{ _t('text-no-papers-available') }}</div>
                @endif
            </div>
        </div>

    </div>




@endsection
