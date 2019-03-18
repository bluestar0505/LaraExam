@extends('layouts.app')

@section('content')



    <div class="container">

        @if(isset($categories) && $categories->count() > 0)
        <div class="panel panel-pale">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <strong>{{ _t('text-found-categories') }}</strong>
                </h3>
            </div>
            <div class="panel-body">

                    <ul class="">
                        @foreach($categories as $c)
                            <li class="">
                                <a href="{{ route('category.show', ['id' => $c->id]) }}">{{ $c->name }}</a>
                            </li>
                        @endforeach
                    </ul>

            </div>
        </div>
        @endif


            @if (isset($papers) && $papers->count() > 0)
        <div class="panel panel-pale">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <strong>{{ _t('text-found-papers') }}</strong>
                </h3>
            </div>
            <div class="panel-body">

                    <ul class="">
                        @foreach($papers as $p)
                            <li class="">
                                @if(in_array($p->id, $userPapers))
                                    <a href="{{ route('paper.show', ['id' => $p->id]) }}">{{ $p->name }}</a> &nbsp;
                                @else
                                    <a >{{ $p->name }}</a> &nbsp;
                                    <a
                                        href="{{route('catalogue.buy', ['paper_id'=>$p->id])}}"
                                        data-toggle="modal"
                                        data-target="#modal_confirm"
                                        title="Buy {{$p->name}} paper"
                                        data-solution="{{$p->name}}"
                                        data-paper="{{$p->id}}"
                                        data-solution-price="{{$p->price}}"
                                        class="buy_button"><i
                                        class="fa fa-plus"
                                        aria-hidden="true"></i>
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>

            </div>
        </div>
            @endif


        @if(isset($categories) && $categories->count() == 0 && isset($papers) && $papers->count() == 0)
            <div class="row">
                <h3>{{ _t('text-nothing-found') }}</h3>
            </div>
        @endif

    </div>

    @if(Auth::user()->wallet > 0)
        {{--modal confirm--}}
        <div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm Purchase:</h4>
                    </div>
                    <div class="modal-body">
                        <p>Purchase <span id="solution_name"></span> for <span id="solution_price"></span> token<span id="solution_plural"></span>.</p>
                        <div class="row">
                            <div class="col-12-xs text-center">
                                <button data-paper="" class="btn btn-success btn-md" id="buy_link" data-dismiss="modal">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @else
        <div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm Purchase:</h4>
                    </div>
                    <div class="modal-body">
                        <p>You don't have enough tokens in your wallet, would you like to buy more?</p>
                        <div class="row">
                            <div class="col-12-xs text-center">
                                <a href="{{route('buy-more.index')}}" class="btn btn-success btn-md">Yes</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endif
    {{--end modal confirm--}}


@endsection
