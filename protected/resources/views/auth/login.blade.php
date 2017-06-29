@extends('layout.login-main')
@section('page-title')
    {{"Login"}}
@endsection
@section('page-content')
      @include('auth.auth-header')
      <section class="inner-wraper">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
              <div class="panel panel-default">
                <div class="panel-heading text-primary">
                  <strong>Login</strong>
                </div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                    <fieldset>
                      <div class="row">
                        <div class="center-block">
                          <img class="profile-img"
                            src="{{asset("protected/storage/uploads/images/logo.png")}}" alt="..." class="img-circle logo_img">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                              </span>
                              <input id="email" type="email" class="form-control" placeholder="Username" name="email" value="{{ old('email') }}" required autofocus>

                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif</div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                              </span>
                              <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>
                          <div class="form-group">
                                <div class="input-group">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                      </label>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
                          </div>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
                <div class="panel-footer ">
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                      Forgot Your Password?
                  </a>
                </div>
                      </div>
            </div>
          </section>
@endsection
