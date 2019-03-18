@extends('layouts.app')

@section('content')
    <div class="main_bcg">
        <div class="container catalogue-page_container">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="color: white">Question and answer</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group">

                        <button class="btn btn-default" data-toggle="modal" data-target="#ask-question"><i
                                    class="fa fa-comments" aria-hidden="true"></i> Post a
                            question
                        </button>
                    </div>
                    <div class="btn-group">

                        <a href="{{route('paper.qa.index', $paper->id)}}" class="btn btn-default"> View all questions
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="qa-panel">
                        <div class="col-md-1 qa-item__vote">
                            <div class="vote_block">
                                <div>
                                    <a href="{{route('paper.qa.vote', $question->id)}}" class="qa-item__vote"
                                       data-value="upvote">
                                        <i class="fa fa-chevron-up" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div>
                                    <span class="points__value">{{$question->points}}</span>
                                </div>
                                <div>
                                    <a href="{{route('paper.qa.vote', $question->id)}}" class="qa-item__vote"
                                       data-value="downvote">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <small>Answers: {{$question->answers->count()}}</small>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-1 qa-item__avatar">
                                    @if($question->user)
                                        {!! gravatar($question->user->email, 56,'mm','r', true, ['class'=>'img-circle','width'=>'31','height'=>'31']) !!}
                                    @else
                                        <img src="/images/avatar.png" alt="" class="img-circle" width="31" height="31">
                                    @endif
                                </div>
                                <div class="col-md-11 qa-item__title">
                                    <h4><a href="{{route('paper.qa.view', $question->id)}}">{{$question->title}}</a>
                                    </h4>
                                    <small>
                                        Submitted: <strong>{{$question->created_at->toDateTimeString()}}</strong> |
                                        Asked by:
                                        @if($question->user)
                                            <strong>{{ $question->user->name }}</strong>
                                        @else
                                            <strong>deleted</strong>
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="panel" style="background-color: #f0f3f5; overflow: hidden">
                                    <div class="panel-body">
                                        <div class="col-md-1">
                                            <i class="fa fa-quote-left fa-4" aria-hidden="true"
                                               style="color: #cad4db"></i>
                                        </div>

                                        <div class="col-md-11">
                                            {{$question->question}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 text-center">

                            <div class="btn-group" style="padding-top: 20px; margin: 0 20px">
                                <a href="{{route('paper.qa.subscribe-toggle', $question->id)}}"
                                   class="toggle-subscribe" style="margin-top: 10px">
                                    <i class="fa {{$question->subscribers->contains(Auth::user()->id) ? 'fa-bell-o' : 'fa-bell-slash-o'}}"
                                       aria-hidden="true"></i>
                                </a>
                            </div>
                            @if($question->user_id == Auth::user()->id)
                                <div class="btn-group" style="padding-top: 20px">
                                    <button data-href="{{route('paper.qa.delete', $question->id)}}"
                                            class="btn btn-default delete_button"
                                            style="margin-top: 20px"
                                            data-toggle="modal"
                                            data-target="#modal_confirm">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="qa-answer_panel">


                        @foreach($answers as $answer)
                            <div class="row">
                                @include('web.questions.answer_block', ['answer'=>$answer])
                            </div>

                        @endforeach
                        @if($answers->isEmpty())
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        no answers yet
                                    </p>
                                </div>
                            </div>
                        @endif


                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                {{--<h4>Post an answer</h4>--}}
                                <div class="row">

                                    <div class="col-md-1 text-center">
                                        {!! gravatar(Auth::user()->email, 56,'mm','r', true, ['class'=>'img-circle','width'=>'31','height'=>'31']) !!}
                                    </div>
                                    <div class="col-md-10">
                                        <form action="{{route('paper.qa.answer.post')}}" method="post">
                                            {!! csrf_field() !!}
                                            <input type="text" name="question_id" value="{{$question->id}}" hidden
                                                   required>
                                            <div class="form-group">
                                            <textarea class="form-control" name="answer"
                                                      placeholder="Input answer"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary" style="margin-bottom: 20px">
                                                Post
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('web.questions.question_modal_form')
    <div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Delete:</h4>
                </div>
                <div class="modal-body">
                    <p>You will delete question with all answers. Are you sure?</p>
                    <div class="row">
                        <div class="col-12-xs text-center">
                            <a href="#" id="delete_link" class="btn btn-success btn-md">Yes</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@push('scripts')
    @include('web.questions.vote_script')
    <script>
        $('.toggle-subscribe').on('click', function (e) {
            linkEl = $(this);
            $.get($(this).attr('href'), {status: $(this).data('value')}, function (response) {

                console.log(response.attached);
                if (response.attached[0]) {
                    linkEl.find('i').addClass('fa-bell-o');
                    linkEl.find('i').removeClass('fa-bell-slash-o');
                } else {
                    linkEl.find('i').removeClass('fa-bell-o');
                    linkEl.find('i').addClass('fa-bell-slash-o');
                }
            });
            e.preventDefault();
            return false;
        })

        $('#modal_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var link = button.data('href'); // Extract info from data-* attributes
            var solution_name = button.data('solution'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#delete_link').attr('href', link)
        });
    </script>
@endpush
