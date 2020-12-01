@extends('admin.layoutLlogin')
@section('content')
<style>
	.wrapper{
		display:  none !important;
	}
</style>
<div class="login-box">
  <div class="login-logo">

  	<img style="width: 80%" src="{{asset('admin/images/mediasoft-logo.jpg')}}">

    <div style="
    font-size: 25px;
"><b> Admin Panel Login</b></div>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <!-- if email or password are not correct -->
    @if( count($errors) > 0)
    	@foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only">Error:</span>
                  {{ $error }}
            </div>
         @endforeach
    @endif

    @if(Session::has('loginError'))
        <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              {!! session('loginError') !!}
        </div>
    @endif

    {!! Form::open(array('url' =>'admin/checkLogin', 'method'=>'post', 'class'=>'form-validate')) !!}

       <div class="form-group has-feedback">
        {!! Form::email('email', '', array('class'=>'form-control email-validate', 'id'=>'email')) !!}
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     Enter your Email</span>
       <span class="help-block hidden"> Enter your Email</span>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
       <input type="password" name='password' class='form-control field-validate' value="">
       <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                   Password</span>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
       <span class="help-block hidden">Password</span>

      </div>
  	  <img src="">
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-4">
          {!! Form::submit(trans('Login'), array('id'=>'login', 'class'=>'btn btn-primary btn-block btn-flat' )) !!}
        </div>
        <!-- /.col -->
      </div>
    {!! Form::close() !!}

  </div>

  <!-- /.login-box-body -->
</div>
