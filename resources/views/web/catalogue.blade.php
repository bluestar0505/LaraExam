@extends('layouts.app', ['bodyClass' => 'catalogue_page'])

@section('content')

<style>
.tab-content .list-group-item h4.panel-title > a:before {
    content: "";
    background: #438abb;
    display: inline-block;
    color: white;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    text-align: center;
    line-height: 14px;
    font-size: 14px;
    font-weight: bold;
    border: 2px solid #c6dcea;
    position: relative;
    top: 1px;
    margin-right: 10px;
}

.tab-content .list-group-item h4.panel-title > a[aria-expanded=false]:before {
    content: "+";
}
.tab-content .list-group-item h4.panel-title > a[aria-expanded=true]:before {
    content: "-";
}
.tab-content .list-group-item > .panel-collapse ul > li:before {
    content: "";
    background: #438abb;
    display: inline-block;
    color: white;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    text-align: center;
    line-height: 20px;
    font-size: 18px;
    font-weight: bold;
    border: 2px solid #e0f2ff;
    position: relative;
    top: 2px;
}
.tab-content .list-group-item > .panel-collapse ul.listSec > li:after {
    top: 24px;
}
.tab-content .list-group-item > .panel-collapse ul > li:after {
    content: "";
    display: block;
    width: 100%;
    max-width: 24px;
    border-top: 2px solid rgba(67, 137, 188, 0.4);
    position: absolute;
    left: 0px;
    top: 21px;
}
.tab-content .list-group-item > .panel-collapse > .panel-body {
    padding-left: 8px;
    padding-bottom: 0;
}
.tab-content .list-group-item > .panel-collapse > .panel-body ul.list-group {
    position: relative;
}
.tab-content .list-group-item > .panel-collapse > .panel-body> ul.list-group.listSec:before {
    top: -24px;
}
.tab-content .list-group-item > .panel-collapse > .panel-body> ul.list-group:before {
    content: "";
    display: block;
    border-left: 1px solid rgba(67, 137, 188, 1);
    position: absolute;
    left: 0px;
    top: -20px;
    height: 100%;
    z-index: 999;
}
.tab-content .list-group-item > .panel-collapse ul > li {
    border: 0px;
    position: relative;
}
.tab-content .list-group-item > .panel-collapse ul > li:before {
    content: "";
    background: #438abb;
    display: inline-block;
    color: white;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    text-align: center;
    line-height: 20px;
    font-size: 18px;
    font-weight: bold;
    border: 2px solid #c6dcea;
    position: relative;
    top: 0px;
    z-index: 1;
    left: 3px;
    margin-right: 16px;
}

ul::-webkit-scrollbar {
    width: 0.25em;
}

ul::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}

ul::-webkit-scrollbar-thumb {
    background-color: white;

}

#vert-scroll-pane {
    max-height: 419px;
    overflow: hidden;
    position: relative;
}

#vert-scroll-pane .categories__block{
    max-height: initial;
    overflow: initial;
}
</style>
              <div  style="background-color:#2579a9;width:100%;">
        <div class="container catalogue-page_container">
           
            <div class="col-md-12">
                
    <h3 class="pageHed" style="color: white">Catalogue <small> </small></h3>
                
                
                <div id="mySliderTabs">
                <ul class="list-inline" role="tablist" style="overflow: auto;white-space: nowrap;">
                        @foreach($categories as $ca)
                            <li role="presentation" class="{{$loop->first ? 'active':''}}" style="margin-bottom: 10px;">
                                <a href="#cat_{{$ca->id}}"
                                   class="btn btn-primary"
                                   aria-controls="home"
                                   role="tab"
                                   data-toggle="tab">{{$ca->name}}</a>
                            </li>
                        @endforeach
                       
                    </ul>
                 
                
                </div>
                </div>
                </div>
                
</div>
                    <!-- Nav tabs -->
                  <div class="main_bcg" style="background: none;">
                  <div class="container catalogue-page_container">
                    <div class="col-md-12">
                   <div style="margin-top: 40px;border: 1px solid #2579a9; position: relative;">
                        <div class="top-arrow-container" ></div>
                        <div class="bottom-arrow-container" ></div>
                    <!-- Tab panes -->
                    <div class="tab-content" id="vert-scroll-pane">
                        
                        @foreach($categories as $rootCat)
                         
                            <div role="tabpanel" class="tab-pane {{$loop->first ? 'active':''}} categories__block listGroupMain"
                                 id="cat_{{$rootCat->id}}" style="overflow:hidden;">
                                @if($rootCat->child->isEmpty() && $rootCat->papers->isNotEmpty())
                                    <div class="list-group-item">
                                    
                                        <div style="position: relative; z-index: 2;">
                                        
                                            <h4 class="panel-title">
                                                <!-- <a href="#"> <i class="fa fa-caret-down" style="color:#2579a9;"></i></a>-->
                                                <a role="button" data-toggle="collapse"
                                                   {{--data-parent="#accordion"--}}
                                                   href="#category_{{$rootCat->id}}" aria-expanded="false"
                                                   aria-controls="category_{{$rootCat->id}}">
                                                   

                                                    {{$rootCat->name}}
                                                    
                                                </a>
                                            </h4>
                                        </div>
                                        
                                        <div id="category_{{$rootCat->id}}" class="panel-collapse collapse"
                                             role="tabpanel"
                                             aria-labelledby="headingOne" style="position: relative; z-index: 1;">
                                            <div class="panel-body">
                                                <ul class="list-group listSec">
                                                    @foreach($rootCat->papers as $paper)
                                                        <li  class="list-group-item" id="paper_{{$paper->id}}">
                                                            @if($boughtPapersIds->contains($paper->id))
                                                                <a href="{{route('paper.show', $paper['id'])}}">{{$paper['name']}}</a>


                                                                <span class="pull-right">
                                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                                </span>

                                                            @else
                                                                {{$paper->name}}

                                                                <a
                                                                        href="{{route('catalogue.buy', ['paper_id'=>$paper->id])}}"
                                                                        data-toggle="modal"
                                                                        data-target="#modal_confirm"
                                                                        title="Buy {{$paper->name}} paper"
                                                                        data-solution="{{$paper->name}}"
                                                                        data-paper="{{$paper->id}}"
                                                                        data-solution-price="{{$paper->price}}"
                                                                        class="pull-right buy_button"><i
                                                                            class="fa fa-plus"
                                                                            aria-hidden="true"></i></a>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @foreach($rootCat->child as $cat)
                                        <div class="list-group-item">
                                            <div style="position: relative; z-index: 2;">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse"
                                                       {{--data-parent="#accordion"--}}
                                                       href="#category_{{$cat->id}}" aria-expanded="false"
                                                       aria-controls="category_{{$cat->id}}">
                                                        {{$cat->name}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="category_{{$cat->id}}" class="panel-collapse collapse"
                                                 role="tabpanel"
                                                 aria-labelledby="headingOne" style="position: relative; z-index: 1;">
                                                <div class="panel-body">
                                                    <ul class="list-group">
                                                        @foreach($cat->papers as $paper)
                                                            <li class="list-group-item" id="paper_{{$paper->id}}">
                                                                @if($boughtPapersIds->contains($paper->id))
                                                                    <a href="{{route('paper.show', $paper['id'])}}">{{$paper['name']}}</a>

                                                                    

                                                                @else
                                                                    {{$paper->name}}
                                                                    <a
                                                                            href="{{route('catalogue.buy', ['paper_id'=>$paper->id])}}"
                                                                            data-toggle="modal"
                                                                            data-target="#modal_confirm"
                                                                            title="Buy {{$paper->name}} paper"
                                                                            data-solution="{{$paper->name}}"
                                                                            data-paper="{{$paper->id}}"
                                                                            data-solution-price="{{$paper->price}}"
                                                                            class="pull-right buy_button"><i
                                                                                class="fa fa-plus"
                                                                                aria-hidden="true"></i></a>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
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
@push('scripts')
    <script>
        function setHide () {
            $(".top-arrow-container").hide();
            $(".bottom-arrow-container").hide();
            if ($( "#vert-scroll-pane" )[0].clientHeight < $( "#vert-scroll-pane .tab-pane.active" )[0].clientHeight) {
                $(".bottom-arrow-container").show();
                $(".top-arrow-container").show();
                if ($( "#vert-scroll-pane" )[0].scrollTop <= 0) {
                    $(".top-arrow-container").hide();
                }
                if ($( "#vert-scroll-pane" )[0].scrollTop + $( "#vert-scroll-pane" )[0].offsetHeight >= $( "#vert-scroll-pane" )[0].scrollHeight) {
                    $(".bottom-arrow-container").hide();
                }
            }
        }
        
        $("a[data-toggle='collapse']").click(function() {
            setTimeout(function(){
                setHide();
            }, 500);
        });
        setHide();
        $("a[data-toggle='tab']").click(function() {
            setTimeout(function(){
                setHide();
            }, 500);
        })
        $( "#vert-scroll-pane" ).scroll(function() {
            setTimeout(function(){
                setHide();
            }, 500);
        });
        $(".top-arrow-container").click(function() {
            $( "#vert-scroll-pane" ).scrollTop( $( "#vert-scroll-pane" )[0].scrollTop - 100 );
        });
        $(".bottom-arrow-container").click(function() {
            $( "#vert-scroll-pane" ).scrollTop( $( "#vert-scroll-pane" )[0].scrollTop + 100 );
        });
        $( "#vert-scroll-pane" ).resize(function() {
            setHide();
        });
        $( "#vert-scroll-pane .tab-pane.active" ).resize(function() {
            setHide();
        });
        var slider = $("div#mySliderTabs").sliderTabs({
            autoplay: false,
            mousewheel: false,
            position: "top"
        });
        $('.buy_button').on('click', function (e) {

            button = $(this);
            $('#modal_confirm').modal('show', function () {
                // var button = $(event.relatedTarget); // Button that triggered the modal
                console.log(button);
                var paper_id = button.data('paper'); // Extract info from data-* attributes
                console.log(paper_id);
                var solution_name = button.data('solution'); // Extract info from data-* attributes
                var solution_price = button.data('solution-price'); // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('#solution_name').text(solution_name);
                modal.find('#solution_price').text(solution_price);
                modal.find('#buy_link').data('paper', paper_id)

                if(parseInt(solution_price) > 1)
                    modal.find('#solution_plural').text('s');
                else
                    modal.find('#solution_plural').text('');
            });
            e.preventDefault();
            return false;
        });
        $('#modal_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var link = button.data('href'); // Extract info from data-* attributes
            var solution_name = button.data('solution'); // Extract info from data-* attributes
            var solution_price = button.data('solution-price'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#solution_name').text(solution_name);
            modal.find('#solution_price').text(solution_price);
            modal.find('#buy_link').data('paper', link)

            if(parseInt(solution_price) > 1)
                modal.find('#solution_plural').text('s');
            else
                modal.find('#solution_plural').text('');
        });


        $('#buy_link').on('click', function () {
            $(this).data('paper');
            console.log($(this).data('paper'));
            $.get('{{route('xhr.catalogue.buy')}}', {paper_id: $(this).data('paper')}, function (response) {
                console.log(response);

                if (response.success) {
                    var html = '<a href="/paper/' + response.paper_id + '">' + response.paper_name + '</a>';
                    $('#paper_' + response.paper_id).html(html);
                    $('#currentBalance').html($('#currentBalance').html() - response.paper_price);
                }
            });
            return true;
        });

    </script>
@endpush