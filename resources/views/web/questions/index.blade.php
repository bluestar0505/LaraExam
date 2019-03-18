@extends('layouts.app')

@section('content')
    <div class="main_bcg">
        <div class="container catalogue-page_container">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="color: white">Question and answer: {{$paper->name}}</h3>
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
                </div>
            </div>
            @foreach($questions as $question)
                <div class="row">
                    <div class="col-md-12">
                        <div class="qa-panel">
                            <div class="col-md-1 qa-item__vote">
                                <div>
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
                                            <img src="/images/avatar.png" alt="" class="img-circle" width="31"
                                                 height="31">
                                        @endif
                                    </div>
                                    <div class="col-md-11 qa-item__title">
                                        <h4><a href="{{route('paper.qa.view', $question->id)}}">{{$question->title}}</a>
                                        </h4>
                                        <small>
                                            Submitted: <strong>{{$question->created_at->toDateTimeString()}}</strong> |
                                            Asked by: <strong>
                                                @if($question->user)
                                                    {{ $question->user->name }}
                                                @else
                                                    deleted
                                                @endif
                                            </strong>
                                        </small>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-1">
                                @if($question->user_id == Auth::user()->id)
                                    <button data-href="{{route('paper.qa.delete', $question->id)}}"
                                            class="btn btn-default delete_button"
                                            style="margin-top: 20px"
                                            data-toggle="modal"
                                            data-target="#modal_confirm">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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