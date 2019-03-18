	@extends('layouts.app')

@section('content')



	<link href="{{ asset('css/style1.css') }}" rel="stylesheet">
	<link href="{{ asset('css/skins/blue.css') }}" rel="stylesheet">
	<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
	<section class="container main-content">
		<div class="row">
			<div class="col-md-9">
				
				<div class="page-content ask-question">
					<div class="boxedtitle page-title"><h2>Ask Question</h2></div>
					
					<p>Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque.</p>
					
					<div class="form-style form-style-3" id="question-submit">
						<form>
							<div class="form-inputs clearfix">
								<p>
									<label class="required">Question Title<span>*</span></label>
									<input type="text" id="question-title">
									<span class="form-description">Please choose an appropriate title for the question to answer it even easier .</span>
								</p>
							
							
								<div class="clearfix"></div>
								<div class="poll_options">
									<p class="form-submit add_poll">
										<button id="add_poll" type="button" class="button color small submit"><i class="icon-plus"></i>Add Field</button>
									</p>
									<ul id="question_poll_item">
										<li id="poll_li_1">
											<div class="poll-li">
												<p><input id="ask[1][title]" class="ask" name="ask[1][title]" value="" type="text"></p>
												<input id="ask[1][value]" name="ask[1][value]" value="" type="hidden">
												<input id="ask[1][id]" name="ask[1][id]" value="1" type="hidden">
												<div class="del-poll-li"><i class="icon-remove"></i></div>
												<div class="move-poll-li"><i class="icon-fullscreen"></i></div>
											</div>
										</li>
									</ul>
									<script> var nextli = 2;</script>
									<div class="clearfix"></div>
								</div>
								
	
								
							</div>
							<div id="form-textarea">
								<p>
									<label class="required">Details<span>*</span></label>
									<textarea id="question-details" aria-required="true" cols="58" rows="8"></textarea>
									<span class="form-description">Type the description thoroughly and in detail .</span>
								</p>
							</div>
							<p class="form-submit">
								<input type="submit" id="publish-question" value="Publish Your Question" class="button color small submit">
							</p>
						</form>
					</div>
				</div><!-- End page-content -->
			</div><!-- End main -->
			
		</div><!-- End row -->
	</section><!-- End container -->
	@endsection