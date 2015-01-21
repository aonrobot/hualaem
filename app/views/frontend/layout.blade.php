<!DOCTYPE html>
<html lang="th" data-wf-site="545f56f8c3684d9f25f51d7e" >
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="https://y7v4p6k4.ssl.hwcdn.net/placeholder/favicon.ico">
        <meta name="generator" content="Webflow">

        
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
                        <a  href="index.html">
                            <img src="{{ URL::asset('images/1415577731_handdrawn-lightbulb-48.png') }}" alt="545faced7848976b2dd62a5e_1415577731_handdrawn-lightbulb-48.png">
                            <em>TGT |<br></em>
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <br>
                        <div class="form">

                            <!-- Form for login-->
                            
                            <form id="email-form" name="login-form" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="icon _48" src="{{ URL::asset('images/1415840683_user-32.png') }}" alt="5463af9714d72b9b0fb5a9c1_1415840683_user-32.png">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control input-sm" id="username" type="text" placeholder="Username" name="username" required="required" autofocus="autofocus" data-name="username">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="btn btn-default btn-sm col-md-12"  value="Sign Up">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="icon _48" src="{{ URL::asset('images/1415840688_lock-open-32.png') }}" alt="5463afee895960d5616d9d09_1415840688_lock-open-32.png">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control input-sm" id="password" type="password" placeholder="Password" name="password" required="required" data-name="password">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="btn btn-default btn-sm col-md-12"  value="Sign In">
                                    </div>
                                </div>
                               
                            </form>

                            <!-- Form for login-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-default" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a class="w-nav-link navlink" href="#">Dashboard</a></li>
                    <li><a class="w-nav-link navlink" href="#">Calendar</a></li>
                    <li><a class="w-nav-link navlink" href="#">Profile</a></li>
                </ul>
            
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="w-nav-link navlink" href="#">Register Camp</a></li>
                </ul>
            </div>
        </div>

        <div class="section">
            @yield('content')
        </div>
        <div class="navbar navbar-default" style="margin:0">
            <div class=" text-center" style="color:#FFF;padding:40px 0;" >© 2014&nbsp;The Gifted and Talented Foundation. All Rights Reserved.</div>
        </div>
        @section('js_foot')
        {{ HTML::script('js/jquery.min.js') }}
        <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
        @show
    </body>
</html>