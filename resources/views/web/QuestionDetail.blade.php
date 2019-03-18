@extends('layouts.app')

@section('content')



	<link href="{{ asset('css/style1.css') }}" rel="stylesheet">
	<link href="{{ asset('css/skins/blue.css') }}" rel="stylesheet">
	<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
<section class="container main-content">
		<div class="row">
			<div class="col-md-9">
				<article class="question single-question question-type-normal">
					<h2>
						<a href="single_question.html">This Is My first Question</a>
					</h2>
					<a class="question-report" href="#">Report</a>
					<div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
					<div class="question-inner">
						<div class="clearfix"></div>
						<div class="question-desc">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ornare, dolor a aliquet rutrum, dolor turpis condimentum leo, a semper lacus purus in felis. Quisque blandit posuere turpis, eget auctor felis pharetra eu .</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ornare, dolor a aliquet rutrum, dolor turpis condimentum leo, a semper lacus purus in felis. Quisque blandit posuere turpis, eget auctor felis pharetra eu .</p>
						</div>
						<div class="question-details">
							<span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
							<span class="question-favorite"><i class="icon-star"></i>5</span>
						</div>
						<span class="question-category"><a href="#"><i class="icon-folder-close"></i>wordpress</a></span>
						<span class="question-date"><i class="icon-time"></i>4 mins ago</span>
						<span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answer</a></span>
						<span class="question-view"><i class="icon-user"></i>70 views</span>
						<span class="single-question-vote-result">+22</span>
						<ul class="single-question-vote">
							<li><a href="#" class="single-question-vote-down" title="Dislike"><i class="icon-thumbs-down"></i></a></li>
							<li><a href="#" class="single-question-vote-up" title="Like"><i class="icon-thumbs-up"></i></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</article>
				

				
				<div class="about-author clearfix">
				    <div class="author-image">
				    	<a href="#" original-title="admin" class="tooltip-n"><img alt="" src="{{ asset('images/avatar.png') }}"></a>
				    </div>
				    <div class="author-bio">
				        <h4>About the Author</h4>
				        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed viverra auctor neque. Nullam lobortis, sapien vitae lobortis tristique.
				    </div>
				</div><!-- End about-author -->
				

				
				<div id="commentlist" class="page-content">
					<div class="boxedtitle page-title"><h2>Answers ( <span class="color">5</span> )</h2></div>
					<ol class="commentlist clearfix">
					    <li class="comment">
					        <div class="comment-body comment-body-answered clearfix"> 
					            <div class="avatar"><img alt="" src="{{ asset('images/avatar.png') }}"></div>
					            <div class="comment-text">
					                <div class="author clearfix">
					                	<div class="comment-author"><a href="#">admin</a></div>
					                	<div class="comment-vote">
						                	<ul class="question-vote">
						                		<li><a href="#" class="question-vote-up" title="Like"></a></li>
						                		<li><a href="#" class="question-vote-down" title="Dislike"></a></li>
						                	</ul>
					                	</div>
					                	<span class="question-vote-result">+1</span>
					                	<div class="comment-meta">
					                        <div class="date"><i class="icon-time"></i>January 15 , 2014 at 10:00 pm</div> 
					                    </div>
					                    <a class="comment-reply" href="#"><i class="icon-reply"></i>Reply</a> 
					                </div>
					                <div class="text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat.</p>
					                </div>
									<div class="question-answered question-answered-done"><i class="icon-ok"></i>Best Answer</div>
					            </div>
					        </div>
					        <ul class="children">
					            <li class="comment">
					                <div class="comment-body clearfix"> 
					                	<div class="avatar"><img alt="" src="{{ asset('images/avatar.png') }}"></div>
					                    <div class="comment-text">
					                        <div class="author clearfix">
					                        	<div class="comment-author"><a href="#">vbegy</a></div>
					                        	<div class="comment-vote">
					                            	<ul class="question-vote">
					                            		<li><a href="#" class="question-vote-up" title="Like"></a></li>
					                            		<li><a href="#" class="question-vote-down" title="Dislike"></a></li>
					                            	</ul>
					                        	</div>
					                        	<span class="question-vote-result">+1</span>
					                        	<div class="comment-meta">
					                                <div class="date"><i class="icon-time"></i>January 15 , 2014 at 10:00 pm</div> 
					                            </div>
					                            <a class="comment-reply" href="#"><i class="icon-reply"></i>Reply</a> 
					                        </div>
					                        <div class="text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat.</p>
					                        </div>
					                    </div>
					                </div>
					                <ul class="children">
					                    <li class="comment">
					                        <div class="comment-body clearfix"> 
					                            <div class="avatar"><img alt="" src="{{ asset('images/avatar.png') }}"></div>
					                            <div class="comment-text">
					                                <div class="author clearfix">
					                                	<div class="comment-author"><a href="#">admin</a></div>
					                                	<div class="comment-vote">
					                                    	<ul class="question-vote">
					                                    		<li><a href="#" class="question-vote-up" title="Like"></a></li>
					                                    		<li><a href="#" class="question-vote-down" title="Dislike"></a></li>
					                                    	</ul>
					                                	</div>
					                                	<span class="question-vote-result">+9</span>
					                                	<div class="comment-meta">
					                                        <div class="date"><i class="icon-time"></i>January 15 , 2014 at 10:00 pm</div> 
					                                    </div>
					                                    <a class="comment-reply" href="#"><i class="icon-reply"></i>Reply</a> 
					                                </div>
					                                <div class="text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat.</p>
					                                </div>
					                            </div>
					                        </div>
					                    </li>
					                 </ul><!-- End children -->
					            </li>
					            <li class="comment">
					            	<div class="comment-body clearfix"> 
				                        <div class="avatar"><img alt="" src="{{ asset('images/avatar.png') }}"></div>
				                        <div class="comment-text">
				                            <div class="author clearfix">
				                            	<div class="comment-author"><a href="#">ahmed</a></div>
				                            	<div class="comment-vote">
				                                	<ul class="question-vote">
				                                		<li><a href="#" class="question-vote-up" title="Like"></a></li>
				                                		<li><a href="#" class="question-vote-down" title="Dislike"></a></li>
				                                	</ul>
				                            	</div>
				                            	<span class="question-vote-result">-3</span>
				                            	<div class="comment-meta">
				                                    <div class="date"><i class="icon-time"></i>January 15 , 2014 at 10:00 pm</div> 
				                                </div>
				                                <a class="comment-reply" href="#"><i class="icon-reply"></i>Reply</a> 
				                            </div>
				                            <div class="text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat.</p>
				                            </div>
				                        </div>
				                    </div>
					            </li>
					        </ul><!-- End children -->
					    </li>
					    <li class="comment">
					        <div class="comment-body clearfix"> 
					            <div class="avatar"><img alt="" src="{{ asset('images/avatar.png') }}"></div>
					            <div class="comment-text">
					                <div class="author clearfix">
					                	<div class="comment-author"><a href="#">2code</a></div>
					                	<div class="comment-vote">
					                    	<ul class="question-vote">
					                    		<li><a href="#" class="question-vote-up" title="Like"></a></li>
					                    		<li><a href="#" class="question-vote-down" title="Dislike"></a></li>
					                    	</ul>
					                	</div>
					                	<span class="question-vote-result">+1</span>
					                	<div class="comment-meta">
					                        <div class="date"><i class="icon-time"></i>January 15 , 2014 at 10:00 pm</div> 
					                    </div>
					                    <a class="comment-reply" href="#"><i class="icon-reply"></i>Reply</a> 
					                </div>
					                <div class="text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat.</p>
					                </div>
					            </div>
					        </div>
					    </li>
					</ol><!-- End commentlist -->
				</div><!-- End page-content -->
				
				<div id="respond" class="comment-respond page-content clearfix">
				    <div class="boxedtitle page-title"><h2>Leave a reply</h2></div>
				    <form action="#" method="post" id="commentform" class="comment-form">
				        <div id="respond-inputs" class="clearfix">
				            <p>
				                <label class="required" for="comment_name">Name<span>*</span></label>
				                <input name="author" type="text" value="" id="comment_name" aria-required="true">
				            </p>
				            <p>
				                <label class="required" for="comment_email">E-Mail<span>*</span></label>
				                <input name="email" type="text" value="" id="comment_email" aria-required="true">
				            </p>
				            <p class="last">
				                <label class="required" for="comment_url">Website<span>*</span></label>
				                <input name="url" type="text" value="" id="comment_url">
				            </p>
				        </div>
				        <div id="respond-textarea">
				            <p>
				                <label class="required" for="comment">Comment<span>*</span></label>
				                <textarea id="comment" name="comment" aria-required="true" cols="58" rows="8"></textarea>
				            </p>
				        </div>
				        <p class="form-submit">
				        	<input name="submit" type="submit" id="submit" value="Post your answer" class="button small color">
				        </p>
				    </form>
				</div>
				
				<div class="post-next-prev clearfix">
				    <p class="prev-post">
				        <a href="#"><i class="icon-double-angle-left"></i>&nbsp;Prev question</a>
				    </p>
				    <p class="next-post">
				        <a href="#">Next question&nbsp;<i class="icon-double-angle-right"></i></a>                                
				    </p>
				</div><!-- End post-next-prev -->	
			</div><!-- End main -->
			
		</div><!-- End row -->
	</section><!-- End container -->


@endsection