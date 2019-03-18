<!-- Modal -->
<div class="modal fade" id="ask-question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('paper.qa.new', $paper->id)}}" method="post">
                {!! csrf_field() !!}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ask question</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputTitle">Title
                        </label>
                        <small class="help-block">Max 250 symbols</small>

                        <textarea class="form-control" name="title" id="inputTitle" rows="4" placeholder="Title"
                                  maxlength="250"></textarea>

                        {{--<input type="text" name="title" class="form-control" placeholder="Title">--}}
                    </div>
                    <div class="form-group">
                        <label for="inputTitle">Question</label>

                        <textarea class="form-control" name="question" rows="8"
                                  placeholder="Ask question"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
