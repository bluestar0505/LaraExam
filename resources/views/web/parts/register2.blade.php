@if($errors->has('login-email'))
    <div class="alert alert-danger">
        {{$errors->first()}}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-info">
        Whoops, it looks like you're already signed in on another device - would you like to sign out?
        {{--<a href="{{ route('remove.loggeduser', ['id' =>  session('error')]) }}" class="btn btn-primary">--}}
        <a href="/logout" class="btn btn-primary">
            Yes please</a>
        <a href="" class="btn btn-danger">No thank you</a>

    </div>
@endif

@if (session('anotherdevice'))
    <div class="alert alert-info">
        Whoops, it looks like you signed in on another device
    </div>
@endif
@if (Session::has('message'))
    <div class="alert alert-info">
        {{session('message')}}
    </div>
@endif

<div class="register2">
    <div class="panel-heading" style="font-size: 23px;"><img src="/images/logo-ico.png" alt="Examhack" class="image-logo"> Create A New Account
    </div>
    {{--<div class="panel-subheading">Learn and advance, create an account and get access to many high quality classes.--}}
    <div class="panel-subheading">Join over 600 students who have hacked thousands of hours from their study time!
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label>{{ _t('placeholder-name') }}
                        <input id="name"
                               type="text"
                               class="form-control"
                               name="name"
                               value="{{ old('name') }}"
                               required
                                {{--autofocus--}}
                        >
                    </label>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label>{{ _t('placeholder-email') }}
                        <input id="email"
                               type="email"
                               class="form-control"
                               name="email"
                               value="{{ old('email') }}" required>
                    </label>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label>{{ _t('placeholder-password') }}
                        <input id="password"
                               type="password"
                               class="form-control"
                               name="password"
                               required>
                    </label>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label>{{ _t('placeholder-confirm-password') }}
                        <input id="password-confirm"
                               type="password"
                               class="form-control"
                               name="password_confirmation"
                               required>
                    </label>
                </div>
            </div>

            <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <div class="checkbox">
                        <label><input id="terms"
                                      type="checkbox"
                                      name="terms"
                                      value="1">
                            <span style="position: relative;top: -5px;">I agree with <a href="/terms.pdf" target="_blank">Terms & Conditions</a></span>
                        </label>
                        @if ($errors->has('terms'))
                            <span class="help-block">
                            <strong>{{ $errors->first('terms') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        {{ _t('text-button-register') }}
                    </button>
                    <br>
                    <!--  <div id="paypal-button"></div>  -->
                </div>
            </div>
        </form>
    </div>
</div>