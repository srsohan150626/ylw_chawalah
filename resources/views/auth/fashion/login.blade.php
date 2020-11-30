@extends('web.fashion.commonlayout.layout')
@push('style')
>
@endpush
@section('contents')
    <div id='loadmeplz' class='loadmeplz' style='display:none;'> </div>
    @include('web.fashion.commonlayout.style')
    {{-- @include('web.fashion.commonlayout.scripts') --}}
    <div class="pollSlider" onClick="closePanelow();"></div>

    <input type='hidden' name='loadme' id='loadme' value='0'>
    @include('web.fashion.commonlayout.shoppingcart')

    <div class="row" style="padding:1 px">
        @include('web.fashion.commonlayout.header')

        <div class="row" style="margin-top:55px;">
            <div class="row" style="background:#FFF; height: 50px;">
                <div class="row">

                    <div class='row text-left style_border_box'>
                        <font size='3em'> <strong>LOGIN</strong> </font>
                    </div>
                </div>

            </div>
        </div>

        <div class="row style_border_product" style="vertical-align:top;">

         <div class="row">
            <div class="row" style="vertical-align:top;">
                <div class="row">                        

                    <div class='row'>
                    <div class="row space-htop">
                    
                    <div class="c6 style_border_box">
                        @if(Session::has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="">@lang('website.Error'):</span>
                                {!! session('loginError') !!}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @endif
                        @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="">@lang('website.success'):</span>
                                        {!! session('success') !!}

                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                        @endif
                    <h2> <strong>LOG IN</strong> </h2>
                    
                     <form action="{{ URL::to('/process-login')}}" method="post"  enctype="multipart/form-data">
                        {{csrf_field()}}
                    <table width="100%" border="0" cellspacing="2" cellpadding="2" class="">
                                <tr>
                                  <td align="left">
                                  </td>
                                  </tr>
                                <tr>
                                  <td align="left"><strong>Email Address:</strong></td>
                                </tr>
                                <tr>
                                <td width="81%" align="left">
                                    <input name="email" type="email" required  id="email"  placeholder="@lang('website.Please enter your valid email address')" style="width: 100%; max-width: 450px;" />
                                      <font id="email_note"> </font>
                                </td>
                                </tr>
                                <tr>
                                  <td align="left"><strong>Password:</strong></td>
                                </tr>
                                <tr>
                                  <td align="left">
                                      <input name="password" type="password" placeholder="Please Enter password" required class="validate[required] text-input" id="password" style="width: 100%; max-width: 450px;"/>
                                  </td>
                                </tr>
                                
                                <tr>
                                  <td align="left">
                                  </td>
                                </tr>
                                
                                <tr>
                                  <td align="left">
                                  
                                  <button type="submit" name="login" id="login" class="btn-danger small"> <strong>Login</strong> </button> 
                                  
                                  </td>
                                </tr>
                                 <tr>
                                  <td align="left"> </td>
                                </tr>
                                 <tr>
                                  <td align="left"><a href="{{ URL::to('/forgotPassword')}}">Forgot your password ?</a></td>
                                </tr>
                              </table>
                            </form> 
                    </div>
                    
                    <div class="c5 style_border_box space-left">
                    
                    <table    width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                       
                      <tr>
                        <td height="2"  align="left" valign="top" >
                        <form action="{{ URL::to('/signupProcess')}}" method="post" name="signup" enctype="multipart/form-data">
                            {{csrf_field()}}
                          <table width="100%" border="0" cellspacing="2" cellpadding="2">
                            <tr>
                              <td align="left">
                                    @if( count($errors) > 0)
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">@lang('website.Error'):</span>
                                            {{ $error }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endforeach
                                    @endif

                                    @if(Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">@lang('website.Error'):</span>
                                            {!! session('error') !!}

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                  
                                  </td>
                            </tr>
                            <tr>
                              <td align="left">
                              
                              <h2> <strong>REGISTER</strong> </h2>
                              
                              </td>
                            </tr>
								
                            <tr>
                              <td align="left"><strong>First Name:</strong></td>
                            </tr>
                            <tr>
                              <td  align="left"> 
                                <strong>
                                    <input name="firstName" type="text" required class="validate[required] text-input" id="firstName" style="width: 100%" placeholder="@lang('website.Please enter your first name')" value="{{ old('firstName') }}"/>
                                </strong></td>
                            </tr>
                            <tr>
                              <td align="left"><strong>Last Name:</strong></td>
                            </tr>
                            <tr>
                               <td  align="left"> 
                                  <strong>
                                  <input name="lastName" type="text" required class="validate[required] text-input" id="lastName" style="width: 100%" placeholder="Please Enter your Last Name" value="{{ old('lastName') }}"/>
                                  </strong>
                              </td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Date of Birth:</strong></td>
                              </tr>
                              <tr>
                                 <td  align="left"> 
                                    <strong>
                                        <input name="customers_dob" type="text" required class="validate[required] text-input customers_dob" data-provide="datepicker" id="customers_dob" placeholder="@lang('website.Please enter your date of birth')" value="{{ old('customers_dob') }}" style="width: 100%"/>
                                    </strong>
                                </td>
                              </tr>
                            <tr>
                              <td align="left"><strong>Email Address:</strong></td>
                            </tr>
                            <tr>
                              <td align="left"><strong>
                                <input name="email" type="text" required class="validate[custom[email]] text-input" autocomplete="off" id="email" style="width: 100%" placeholder="Enter Your Email" value="{{ old('email') }}">
                                </strong></td>
                            </tr>
                            <tr>
                              <td align="left"><strong>Mobile:</strong></td>
                            </tr>
                            <tr>
                              <td align="left" class="text-left"><strong>
                                <input name="phone" type="text" required id="phone" style="width: 100%; font-weight:bold; font-size: 1.1em; color: red; text-align:left;" placeholder="@lang('website.Please enter your valid phone number')" value="{{ old('phone') }}" />
                              </strong></td>
                            </tr>
                            <tr>
                              <td align="left"><strong>Password:</strong></td>
                            </tr>
                            <tr>
                              <td align="left"><strong>
                                <input name="password" type="password" required autocomplete="off" class="validate[required] text-input" id="password" style="width: 100%" placeholder="@lang('website.Please enter your password')" />
                              </strong></td>
                            </tr>
                            <tr>
                              <td align="left"><strong>Confirm Password:</strong></td>
                            </tr>
                            <tr>
                              <td align="left"><strong>
                                <input name="re_password" type="password" required class="validate[confirm[password]] text-input" id="re_password" style="width: 100%" placeholder="Enter Your Password"/>
                              </strong></td>
                            </tr>
                            <tr>
                              <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="left"><button type="submit" name="register" id="register" class="btn-danger"><strong>Register</strong></button></td>
                            </tr>
                            <tr>
                              <td align="left"><strong>Have an account </strong>? <a href="{{ URL::to('/login')}}"><strong>Sign In</strong></a></td>
                            </tr>
                            <tr>
                              <td align="left">By clicking on 'Register' above you agree that you accept the <a href="Terms_of_Use.html"><strong>Terms of Use</strong></a></td>
                            </tr>
                            <tr>
                              <td align="left">&nbsp;</td>
                            </tr>
                          </table>
                        </form>
                    </td>
                      </tr>
                    </table>
                    
                    </div>
                    
                    </div>
                </div>    
                 
            </div>    
         </div>                    
     
        <div class="row">
            @include('web.fashion.layouts.footer')

        </div>
        </div>

    </div> <!-- End of theme layout -->

    @include('web.fashion.common.credit')


    @include('web.fashion.commonlayout.scripts')
    @push('scripts')
        <script src="{{ asset('web/fancybox3/jquery.fancybox.min.js') }}"></script>
        <script src="{{ asset('web/css_fashion/verticaltab/js/easyResponsiveTabs.js') }}"></script>
        <script src="{{ asset('web/cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js') }}"></script>
        
    <script type="text/javascript" src="{{asset('web/assets/js/plugins.min.js')}}"></script>
    <!-- Main js -->
    <script type="text/javascript" src="{{asset('web/assets/js/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/css_fashion/drawer/drawer.js')}}"></script>
    <script src="{{asset('web/cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.js')}}"></script>
       
       
    @endpush
@endsection
