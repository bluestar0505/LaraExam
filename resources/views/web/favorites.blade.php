@extends('layouts.app')

@section('content')
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
    .tab_list{ margin: 0; padding: 0;}
/*    .tab_list li.active{ border-bottom: 4px solid white;}*/
    .tab_list li:first-child { padding-left: 0; }
    .tab_list li{ text-decoration: none; padding: 10px 15px; margin: 0!important;}
    .tab_list li a{ text-decoration: none; margin: 0; padding: 10px 0;color: white; border: none; font-size: 15px; letter-spacing: 1px;}
    .tab_list li a:active{ text-decoration: none; }
    .tab_list li.active a{ border-bottom: 4px solid white;}

    #vert-scroll-pane-2, #vert-scroll-pane-1 {
        position: relative;
        max-height: 419px;
        overflow: hidden;
        z-index: 1;
    }
    .favourite-description, .module-description {
        display: none;
    }
    .favourite-selected .favourite-description {
        display: block;
    }
    .module-selected .module-description {
        display: block;
    }
</style>
<div  style="background-color:#2579a9;width:100%;">
    <div class="container favourite-page_container">

        <div class="col-md-12">

            <h3 class="pageHed favourite-selected" style="color: white">
                <span class="favourite-description">My Favourites <small>My favourite modules for quick access</small></span>
                <span class="module-description">My Modules <small>My portfolio of modules</small></span>
            </h3>
            <div>
                <ul class="list-inline tab_list" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#favourites_content"
                           aria-controls="home" role="tab"
                           data-toggle="tab">Favourites</a>
                    </li>
                    <li role="presentation" >
                        <a href="#modules_content"
                           aria-controls="home" role="tab"
                           data-toggle="tab">My Modules</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="main_bcg" style="background: none;">
    <div class="container catalogue-page_container">
        <div class="col-md-12 col-sm-12">
            <div >
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active favourites_block moduleSec favSec" id="favourites_content" style="overflow:hidden;">
                        <div class="">
                            <p></p>
                            <div class="col-md-8 col-sm-12" style="margin-top: 40px; @if(count($categoriesFavorite) >0) border: 1px solid #2579a9; @endif padding: 0; border-radius: 4px;">
                                <div class="top-arrow-container top-arrow-container-1" ></div>
                                <div class="bottom-arrow-container bottom-arrow-container-1" ></div>
                                <div id="vert-scroll-pane-1">
                                    <div class="list-group" id="accordionFavorites" role="tablist" aria-multiselectable="true" >
                                        @foreach($categoriesFavorite as $catFav)
                                        <div class="list-group-item">
                                            <div style="position: relative; z-index: 2;">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse"
                                                    {{--data-parent="#accordionFavorites"--}}
                                                    href="#category_fav_{{$catFav['id']}}" aria-expanded="true"
                                                    aria-controls="category_{{$catFav['id']}}">
                                                        {{$catFav['name']}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="category_fav_{{$catFav['id']}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" style="position: relative; z-index: 1;">
                                                <div class="panel-body">
                                                    <ul class="list-group moduleList">
                                                        @foreach($catFav['papers'] as $favPaper)
                                                        <li class="list-group-item">
                                                            <div class="listContent">
                                                            <a href="{{route('paper.show', $favPaper['id'])}}">{{$favPaper['name']}}</a>
                                                            <div class="pull-right">
                                                                {{--<a href="{{route('paper.qa.index', $favPaper['id'])}}"><b>Q&A</b></a>--}}&nbsp;
                                                                <a href="{{route('catalogue.fav', ['paper_id'=>$favPaper['id']])}}">
                                                                    <i
                                                                        class="fa {{$favoritesPapersIds->contains($favPaper['id']) ? 'fa-star' :'fa-star-o'}}"
                                                                        aria-hidden="true"></i></a>
                                                            </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="recently_viewed_block">
                                    <p class="recently_viewed_title">Recently Viewed</p>
                                    <ul class="recently_viewed_list" style="min-height: 130px;">
                                        @foreach($lastViewed as $viewed)
                                            <li>
                                                <a href="{{route('paper.show', $viewed->id)}}">{{$viewed->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>    
                        </div>

                    </div>

                    <div role="tabpanel" class="tab-pane modules_block moduleSec" id="modules_content" style="overflow:hidden; margin-top: 40px;border: 1px solid #2579a9; border-radius: 4px; position: relative;">
                        <div class="top-arrow-container top-arrow-container-2" ></div>
                        <div class="bottom-arrow-container bottom-arrow-container-2" ></div>
                        <div id="vert-scroll-pane-2">
                            <div class="list-group" id="accordionCategories" role="tablist" aria-multiselectable="true">
                                @foreach($categories as $catItem)
                                <div class="list-group-item">
                                    <div style="position: relative; z-index: 2;">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse"
                                            {{--data-parent="#accordionCategories"--}}
                                            href="#category_{{$catItem['id']}}" aria-expanded="false"
                                            aria-controls="category_{{$catItem['id']}}">
                                                {{$catItem['name']}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="category_{{$catItem['id']}}" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingOne" style="position: relative; z-index: 1;">
                                        <div class="panel-body">
                                            <ul class="list-group moduleList">
                                                @foreach($catItem['papers'] as $paper)
                                                <li class="list-group-item">
                                                    <div class="listContent">
                                                    <a href="{{route('paper.show', $paper['id'])}}">{{$paper['name']}}</a>
                                                    <div class="pull-right">
                                                        {{--<a href="{{route('paper.qa.index', $paper['id'])}}"><b>Q&A</b></a>--}}
                                                        <a href="{{route('catalogue.fav', ['paper_id'=>$paper['id']])}}">
                                                            <i class="fa {{$favoritesPapersIds->contains($paper['id']) ? 'fa-star' :'fa-star-o'}}"
                                                            aria-hidden="true"></i></a>
                                                    </div>
                                                    </div>    
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@push('scripts')
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
@endpush
@push('scripts')
<script>

    $("a[href='#favourites_content']").click(function() {
        $(".module-selected").removeClass("module-selected");
        $(".pageHed").addClass("favourite-selected");
    });
    $("a[href='#modules_content']").click(function() {
        $(".pageHed").addClass("module-selected");
        $(".favourite-selected").removeClass("favourite-selected");
    });
    function setHide1 () {
        $(".top-arrow-container-1").hide(0);
        $(".bottom-arrow-container-1").hide(0);
        if ($( "#vert-scroll-pane-1" )[0].clientHeight < $( "#accordionFavorites" )[0].clientHeight) {
            $(".bottom-arrow-container-1").show(0);
            $(".top-arrow-container-1").show(0);
            if ($( "#vert-scroll-pane-1" )[0].scrollTop <= 0) {
                $(".top-arrow-container-1").hide(0);
            }
            if ($( "#vert-scroll-pane-1" )[0].scrollTop + $( "#vert-scroll-pane-1" )[0].offsetHeight >= $( "#vert-scroll-pane-1" )[0].scrollHeight) {
                $(".bottom-arrow-container-1").hide(0);
            }
        }
    }

    function setHide2 () {
        $(".top-arrow-container-2").hide();
        $(".bottom-arrow-container-2").hide();
        if ($( "#vert-scroll-pane-2" )[0].clientHeight < $( "#accordionCategories" )[0].clientHeight) {
            $(".bottom-arrow-container-2").show();
            $(".top-arrow-container-2").show();
            if ($( "#vert-scroll-pane-2" )[0].scrollTop <= 0) {
                $(".top-arrow-container-2").hide();
            }
            if ($( "#vert-scroll-pane-2" )[0].scrollTop + $( "#vert-scroll-pane-2" )[0].offsetHeight >= $( "#vert-scroll-pane-2" )[0].scrollHeight) {
                $(".bottom-arrow-container-2").hide();
            }
        }
    }
    
    setHide1();
    setHide2();

    $("a[data-toggle='collapse']").click(function() {
        setTimeout(function(){
            setHide1();
            setHide2();  
        }, 100);
    });
    $("a[href='#modules_content']").click(function() {
        setTimeout(function(){
            setHide1();
            setHide2();    
        }, 100);
    })
    $("a[href='#favourites_content']").click(function() {
        setTimeout(function(){
            setHide1();
            setHide2();    
        }, 100);
    })
    $( "#vert-scroll-pane-1" ).scroll(function() {
        setTimeout(function(){
            setHide1();
        }, 100);
    });
    $(".top-arrow-container-1").click(function() {
        $( "#vert-scroll-pane-1" ).scrollTop( $( "#vert-scroll-pane-1" )[0].scrollTop - 100 );
        console.log($( "#vert-scroll-pane-1" )[0].scrollTop, $( "#vert-scroll-pane-1" )[0].scrollHeight)
    });
    $(".bottom-arrow-container-1").click(function() {
        $( "#vert-scroll-pane-1" ).scrollTop( $( "#vert-scroll-pane-1" )[0].scrollTop + 100 );
        console.log($( "#vert-scroll-pane-1" )[0].scrollTop, $( "#vert-scroll-pane-1" )[0].scrollHeight)
    });
    $( "#vert-scroll-pane-1" ).resize(function() {
        setHide1();
    });
    $( "#accordionFavorites" ).resize(function() {
        setHide1();
    });

    $( "#vert-scroll-pane-2" ).scroll(function() {
        setTimeout(function(){
            setHide2();
        }, 100);
    });
    $(".top-arrow-container-2").click(function() {
        $( "#vert-scroll-pane-2" ).scrollTop( $( "#vert-scroll-pane-2" )[0].scrollTop - 100 );
        console.log($( "#vert-scroll-pane-2" )[0].scrollTop);
    });
    $(".bottom-arrow-container-2").click(function() {
        $( "#vert-scroll-pane-2" ).scrollTop( $( "#vert-scroll-pane-2" )[0].scrollTop + 100 );
        console.log($( "#vert-scroll-pane-2" )[0].scrollTop)
    });
    $( "#vert-scroll-pane-2" ).resize(function() {
        setHide2();
    });
    $( "#accordionCategories" ).resize(function() {
        setHide2();
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href");
        if ((target == '#favourites_content')) {
            $(".portfolio_message").text('My favourite modules for quick access');
        } else {
            $(".portfolio_message").text('My personal collection of solutions');
        }
    });
</script>
@endpush