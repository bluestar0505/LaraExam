<nav class="navbar navbar-pale-blue {{Auth::check() ? 'nav-logged' : ''}} navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('web.index') }}">
<!--
                <img src="/images/logo-ico.png" class="d-inline-block align-top logo-image" alt="" width="24"
                     height="26">
-->
                <span class="c-dark-blue">Exam</span><span class="c-light-blue">Hack</span>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            @if(Auth::check())

                <div class="nav-search navbar-form navbar-left searchNav" style="position: relative; margin-left: 300px;top: 5px;">
                <form action="{{ route('search.submit') }}" method="POST">
                {{ csrf_field() }}

                <div class="input-group @if(Session::has('searchError')) error-search @endif">
                <input type="text" id="search" name="search" class="form-control"
                placeholder="{{ _t('placeholder-search-for') }}">
                <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
                </div>

                </form>
                </div>

                <ul class="nav navbar-nav nav-dropdown navbar-right">

                    <li class="userNm">
                        <a href="{{ route('catalogue.favorites') }}"
                           aria-expanded="false"  style="padding-top: 16px">

                            <strong>{{ Auth::user()->name }}</strong>
                        </a>
                    </li>
                    <li class="home">
                        <a href="{{ route('catalogue.index') }}" style="padding-top: 16px"><strong>Home</strong></a>
                    </li>
                    <li>
                        {{--<a href="#" ><i class="fa fa-diamond fa-2x" aria-hidden="true"></i><span--}}
                        {{--class="badge">{{Auth::user()->wallet}}</span></a>--}}

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false"><i class="fa fa-diamond fa-2x"
                                                                         aria-hidden="true"></i> 
<!--                            <span class="caret"></span>-->
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#" onclick="return false;">Current balance: <span id="currentBalance">{{Auth::user()->wallet}}</span></a></li>
                            <li><a href="{{route('buy-more.index')}}">Buy more tokens</a></li>
                            {{--<li><a href="#">Something else here</a></li>--}}
                            {{--<li role="separator" class="divider"></li>--}}
                            {{--<li><a href="#">Separated link</a></li>--}}
                        </ul>
                    </li>
                   {{-- <li>
                        <a href="#" onclick="suggestion(); return false;"><i class="fa fa-lightbulb-o fa-2x"
                                                                             aria-hidden="true"></i></a>
                    </li>--}}
                    <li>
                        <a href="#" id="notificationLink"><i class="fa fa-bell-o fa-2x" aria-hidden="true"></i> <span
                                    class="badge" id="total_notifications"></span>
                        </a>

                    </li>


                    {{--<img onMouseOver="this.style.cursor='pointer'" src="{{{ asset('images/suggestion1.png') }}}"--}}
                    {{--width="20" height="20" style="margin-top: 15px;" onclick="suggestion();">--}}
                    {{--<img onMouseOver="this.style.cursor='pointer'" src="{{{ asset('images/notification.png') }}}"--}}
                    {{--width="20" height="20" style="margin-top: 15px;" >--}}

                    <div id="notificationContainer" style="display: none">
                        <div id="notificationTitle" style="color: black">Notifications</div>
                        <div id="notificationsBody" class="notifications">
                            <ul class="list-group">


                            </ul>
                        </div>
                        <div id="notificationFooter"><a href="#">See All</a></div>
                    </div>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle logOut" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
<!--                            <span class="caret"></span>-->
                        </a>
                        <ul class="dropdown-menu">

                            <li>
                                <a href="{{ route('profile.index') }}">{{ _t('text-nav-profile') }}</a>
                            </li>
                            @if(\App\User::isAdmin())
                                <li>
                                    <a href="{{ url('admin') }}">{{ _t('text-nav-admin') }}</a>
                                </li>
                            @endif
                            {{--<li role="separator" class="divider"></li>--}}
                            <li>
                                <a href="{{ route('logout') }}">{{ _t('text-nav-logout') }}</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            @else
                <form class="form-login navbar-form navbar-right"
                      role="form"
                      method="POST"
                      action="{{ url('login') }}">
                    <input type="hidden"
                           name="_token"
                           value="{{ csrf_token() }}">

                    <div class="form-group   @if(isset($errors) && $errors->default->has('login-email')) error-login @endif">
                        <input type="email"
                               class="form-control"
                               name="login-email"
                               value="{{ old('login-email') }}"
                               placeholder="{{ _t('placeholder-email') }}"
                               {{--autofocus--}}
                               required
                        >
                    </div>

                    <div class="form-group  @if(isset($errors) && $errors->default->has('login-email')) error-login @endif">
                        <input type="password"
                               class="form-control"
                               name="login-password"
                               placeholder="Password"
                               required
                        >
                    </div>

                    {{--<div class="form-group">--}}
                    {{--<div class="col-md-6 col-md-offset-4">--}}
                    {{--<label>--}}
                    {{--<input type="checkbox"--}}
                    {{--name="remember">{{ trans('quickadmin::auth.login-remember_me') }}--}}
                    {{--</label>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    <button type="submit"
                            class="btn btn-primary">
                        {{ _t('button-login') }}
                    </button>

                    <div class="clearfix"></div>

                    <div class="forgot">
                        <a href="{{ url('password/reset') }}">{{ _t('text-forgot-password') }}</a>
                    </div>
                </form>
            @endif

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>