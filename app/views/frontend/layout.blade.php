<!DOCTYPE html>
<html lang="th" data-wf-site="545f56f8c3684d9f25f51d7e" >
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="https://y7v4p6k4.ssl.hwcdn.net/placeholder/favicon.ico">
        <meta name="generator" content="Webflow">
        <base href="{{ URL::to('/') }}/">

        @section('css')
        {{ HTML::style('css/bootstrap.min.css') }}
        @show
        {{ HTML::style('css/custom.css') }}

        @section('js_head')
        {{ HTML::script('js/modernizr.js') }}
        @show
    </head>
    <body>
        <div class="navbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <a  href="{{ URL::to('/') }}">
                            <img src="{{ URL::asset('images/1415577731_handdrawn-lightbulb-48.png') }}" alt="545faced7848976b2dd62a5e_1415577731_handdrawn-lightbulb-48.png">
                            <em>TGT |<br></em>
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        @if(!Auth::check())
                        <br>
                        <div class="form">

                            <!-- Form for login-->

                            <form method="POST" action="{{ URL::route('guest.login') }}" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="icon _48" src="{{ URL::asset('images/1415840683_user-32.png') }}" alt="5463af9714d72b9b0fb5a9c1_1415840683_user-32.png">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control input-sm" id="email" type="email" placeholder="Email" name="email" required="required" tabindex="1">
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ URL::route('guest.register') }}" class="btn btn-default btn-sm col-md-12" tabindex="4">Sign Up</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="icon _48" src="{{ URL::asset('images/1415840688_lock-open-32.png') }}" alt="5463afee895960d5616d9d09_1415840688_lock-open-32.png">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control input-sm" id="password" type="password" placeholder="Password" name="password" required="required" tabindex="2">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="btn btn-default btn-sm col-md-12" type="submit" value="Sign In" tabindex="3">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="">Forgot Password?</a>
                                    </div>
                                </div>

                            </form>
                            
                            <!-- Form for login-->

                        </div>
                        @else
                            <div class="pull-right">
                                <strong>{{ Auth::user()->fullname_th }}</strong><br>
                                <a href="{{ route('user.profile.view') }}">My Profile</a><br>
                                @if(Auth::user()->role == 'ADMIN')
                                    <a href="{{ URL::to('/admin') }}">Admin</a><br>
                                @endif
                                <a href="{{ route('user.logout') }}">Logout</a><br>
                            </div>
                            <div class="pull-right">
                                <div style="vertical-align: middle; height: 80px; position: relative; width: 50px;">
                                    <a href="#" data-poload="{{ route('user.notification') }}" style="display: block; position: absolute; top: 50%; margin-top: -15px;">
                                        <i class="fa fa-bell-o" style="font-size: 30px;"></i>
                                        @if(Auth::user()->un_read)
                                            <div class="notification-number">
                                                {{ Auth::user()->un_read }}
                                            </div>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-default" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
            <div class="container">
                @if(Auth::check())
                <ul class="nav navbar-nav">
                    <li><a class="w-nav-link navlink" href="{{ URL::route('user.student.calendar') }}">Calendar</a></li>
                    <li><a class="w-nav-link navlink" href="{{ route('user.profile.view') }}">Profile</a></li>
                </ul>
                @endif

                <ul class="nav navbar-nav navbar-right">
                    <li><a class="w-nav-link navlink" href="{{ URL::route('guest.camp.list') }}">Register Camp</a></li>
                </ul>
            </div>
        </div>
        @if(!empty($infos))
            <div class="container">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($infos as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if($errors->any())
        <div class="container">
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul>
                    @foreach ($errors->all('<li>:message</li>') as $message)
                    {{ $message }}
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="section">
            @yield('content')
        </div>
        <div class="navbar navbar-default" style="margin:0">
            <div class=" text-center" style="color:#FFF;padding:40px 0;" >© 2014&nbsp;The Gifted and Talented Foundation. All Rights Reserved.</div>
        </div>
        @section('js_foot')
        {{ HTML::script('js/jquery.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
        <script>
            $(document).ready(function(){
                var poLoadFn = function() {
                    var e=$(this);
                    e.off('click');
                    $.get(e.data('poload'),function(d) {
                        e.popover({content: d,html:true,placement:'bottom'}).popover('show');
                        $('.notification-number').css('visibility','hidden');
                        e.click(function(){
                            e.popover('destroy');
                            e.click(poLoadFn);
                        });
                    });
                };

                $('*[data-poload]').click(poLoadFn);
            });

        </script>

        @show
    </body>
</html>