@extends('user.layouts.app')

@section('content')

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li><center><b>{{ $error }}</b></center></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger">
                    <ul>
                       <li><b><center>{{session()->get('error')}}</center></b></li> 
                    </ul>
                    </div>
                @endif
    <!--==================== page content ====================-->

    <div class="page-section pb-40">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">

                    <!-- Login Form s-->
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf

                        <div class="login-form">
                            <h4 class="login-title">Login</h4>

                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address*</label>
                                    <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                </div>
                                
                                <div class="col-12 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="col-md-8">
                                    
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" name="remember" id="remember">
                                        <label for="remember_me">Remember me</label>
                                    </div>
                                    
                                </div>

                                <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                    <a href="{{route('show.reset.password')}}"> Forgot Password?</a>
                                </div>

                                <div class="col-md-12">
                                    <button class="register-button mt-0">Login</button>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>

                <!-- Register Form -->
                

                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <form method="POST" action="{{route('user.register')}}">
                        @csrf

                        <div class="login-form">
                            <h4 class="login-title">Register</h4>

                            <div class="row">
                                <div class="col-md-6 col-12 mb-20">
                                    <label>First Name</label>
                                    <input class="mb-0" type="text" name ="first_name" placeholder="First Name">
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Last Name</label>
                                    <input class="mb-0" type="text" name ="last_name" placeholder="Last Name">
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Email Address*</label>
                                    <input class="mb-0" type="email" name ="email" placeholder="Email Address">
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" type="password" name ="password" placeholder="Password">
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Confirm Password</label>
                                    <input class="mb-0" type="password" name ="password_confirmation" placeholder="Confirm Password">
                                </div>
                                <div class="col-12">
                                    <button class="register-button mt-0">Register</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!--====================  End of page content  ====================-->

@endsection

