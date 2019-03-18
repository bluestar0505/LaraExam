<div class="col-md-12 qa-answer_block">
    <div class="row">
        <div class="col-md-1">
            <div class="qa-item__avatar">
                @if($answer->user)
                    {!! gravatar($answer->user->email, 56,'mm','r', true, ['class'=>'img-circle','width'=>'31','height'=>'31']) !!}
                @else
                    <img src="/images/avatar.png" alt="" class="img-circle" width="31" height="31">
                @endif
            </div>
            <div class="qa-item__vote">
                <div>
                    <a href="{{route('paper.answer.vote', $answer->id)}}"
                       class="qa-item__vote"
                       data-value="upvote">
                        <i class="fa fa-chevron-up" aria-hidden="true"></i>
                    </a>
                </div>
                <div>
                    <span class="points__value">{{$answer->points}}</span>
                </div>
                <div>
                    <a href="{{route('paper.answer.vote', $answer->id)}}"
                       class="qa-item__vote"
                       data-value="downvote">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="btn-group pull-right">
                @if($answer->user_id == Auth::user()->id)
                    <button data-href="{{route('paper.answer.delete', $answer->id)}}"
                            class="btn btn-default delete_button"
                            data-toggle="modal"
                            data-target="#modal_confirm">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                @endif
            </div>
            <div>
                @if($answer->user)
                    {{ $answer->user->name }}
                @else
                    deleted
                @endif
            </div>
            <div>
                <small>{{$answer->created_at->diffForHumans()}}</small>
            </div>

            <div class="row">
                <div class="panel" style="background-color: #f0f3f5; overflow: hidden">
                    <div class="panel-body">
                        <div class="col-md-1">
                            <i class="fa fa-quote-left fa-4" aria-hidden="true"
                               style="color: #cad4db"></i>
                        </div>

                        <div class="col-md-11">
                            {{$answer->answer}}
                        </div>

                    </div>
                </div>

                @foreach($answer->childs as $child)
                    <div class="row">
                        <div class="col-md-12 qa-answer_block">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="qa-item__avatar">
                                        @if($child->user)
                                            {!! gravatar($child->user->email, 56,'mm','r', true, ['class'=>'img-circle','width'=>'31','height'=>'31']) !!}
                                        @else
                                            <img src="/images/avatar.png" alt="" class="img-circle" width="31" height="31">
                                        @endif
                                    </div>
                                    <div class="qa-item__vote">
                                        <div>
                                            <a href="{{route('paper.answer.vote', $child->id)}}"
                                               class="qa-item__vote"
                                               data-value="upvote">
                                                <i class="fa fa-chevron-up" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <span class="points__value">{{$child->points}}</span>
                                        </div>
                                        <div>
                                            <a href="{{route('paper.answer.vote', $child->id)}}"
                                               class="qa-item__vote"
                                               data-value="downvote">
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="btn-group pull-right">
                                        @if($child->user_id == Auth::user()->id)
                                            <button data-href="{{route('paper.answer.delete', $child->id)}}"
                                                    class="btn btn-default delete_button"
                                                    data-toggle="modal"
                                                    data-target="#modal_confirm">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        @endif
                                    </div>
                                    <div>
                                        @if($child->user)
                                            {{ $child->user->name }}
                                        @else
                                            deleted
                                        @endif
                                    </div>
                                    <div>
                                        <small>{{$child->created_at->diffForHumans()}}</small>
                                    </div>
                                    <div class="row">
                                        <div class="panel" style="background-color: #f0f3f5; overflow: hidden">
                                            <div class="panel-body">
                                                <div class="col-md-1">
                                                    <i class="fa fa-quote-left fa-4" aria-hidden="true"
                                                       style="color: #cad4db"></i>
                                                </div>

                                                <div class="col-md-11">
                                                    {{$child->answer}}
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row">
                    <div class="col-md-12">
                        {{--<h4>Post an answer</h4>--}}
                        <div class="row">

                            <div class="col-md-1">
                                {!! gravatar(Auth::user()->email, 56,'mm','r', true, ['class'=>'img-circle','width'=>'31','height'=>'31']) !!}
                            </div>
                            <div class="col-md-10">
                                <form action="{{route('paper.qa.answer.post')}}" method="post">
                                    {!! csrf_field() !!}
                                    <input type="text" name="parent_answer_id" value="{{$answer->id}}" hidden required>
                                    <div class="form-group">

                                    <textarea class="form-control" name="answer"
                                              placeholder="Input answer"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post</button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
