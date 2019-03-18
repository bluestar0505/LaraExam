@extends('layouts.app')

@section('content')
    <div class="col-sm-12 noselect">
        <h1>{{ $paper->name }}</h1>
        <div class="pull-right">
            {{--<a href="{{route('paper.qa.index', $paper->id)}}">Q&A</a>--}}
            <input type="hidden" value="{{$paper->name}}" id="questionName">
            <a id="reportIssue" style="cursor: pointer;" onclick="reportPaperError()">Report issue</a>
            &nbsp;
            <a href="{{route('catalogue.fav', ['paper_id'=>$paper->id])}}">
                <i class="fa {{$favoritesPapersIds->contains($paper->id) ? 'fa-star' :'fa-star-o'}}"
                   aria-hidden="true"></i></a>
            &nbsp;&nbsp;&nbsp;<?php $likeRoute  = $paper->userLikingStatus() === 1 ? 'unlike' : 'like'?>
            <a style="cursor: pointer;" href="{{ route('paper.' . $likeRoute, ['id' => $paper->id]) }}">
                <i class="fa {{ $paper->userLikingStatus() === 1 ? 'fa-thumbs-up' : 'fa-thumbs-o-up' }} fa-lg" aria-hidden="true"> {{--<span id="likesCount">{{ $paper->likes() }}</span>--}} </i>
            </a>
            &nbsp;&nbsp;&nbsp;<?php $dislikeRoute  = $paper->userLikingStatus() === 0 ? 'undislike' : 'dislike'?>
            <a style="cursor: pointer;" href="{{ route('paper.' . $dislikeRoute, ['id' => $paper->id]) }}">
                <i class="fa {{ $paper->userLikingStatus() === 0 ? 'fa-thumbs-down' : 'fa-thumbs-o-down' }} fa-lg" aria-hidden="true"> {{--<span id="dislikesCount">{{ $paper->dislikes() }}</span>--}} </i>
            </a>
        </div>
    </div>
    <div class="col-sm-12 noselect">

        <!--   <div id="sticky-anchor"></div>
         -->
        <!--   <div id='sticky' style="background-color: #3097D1;"></div> -->
        <div id="content noselect">{!! $paper->text !!}</div>
        <!-- <div id="footer123"></div> -->
    </div>
@endsection
