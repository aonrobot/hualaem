<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ URL::to('/') }}/">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    {{ HTML::style('frontend/css/bootstrap.min.css') }}

    <!-- Custom CSS -->
    {{ HTML::style('frontend/css/freelancer.css') }}

    <!-- Custom Fonts -->
    {{ HTML::style('frontend/font-awesome/css/font-awesome.min.css') }}
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    @yield('css')

    {{ HTML::style('frontend/css/custom.css') }}

    @yield('js_head')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">
<div class="freelancer">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('guest.index') }}">Hualaem</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a href="{{ route('guest.camp.list') }}">Camp</a>
                    </li>
                    @if(Auth::guest())
                    <li>
                        <a href="{{ URL::route('guest.login') }}">Login</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('guest.register') }}">Register</a>
                    </li>
                    @endif
                    @if(Auth::check())
                        <li>
                            <a href="{{ URL::route('user.profile.view') }}">My Profile</a>
                        </li>
                        <li>
                            <a href="{{ URL::route('user.pm.list') }}">
                                PM
                                @if(Auth::user()->un_read_pm > 0)
                                    ( {{Auth::user()->un_read_pm }} )
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::route('user.student.calendar') }}">Calendar</a>
                        </li>
                        @if(Auth::user()->role == 'ADMIN')
                        <li>
                            <a href="{{ URL::to('admin') }}">Admin</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ URL::route('user.logout') }}">Logout</a>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</div>

<div class="main-container">
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

    @yield('content')
</div>

<div class="freelancer">
    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Your Website 2014
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
</div>

<!-- jQuery -->
{{ HTML::script("frontend/js/jquery.js") }}

<!-- Bootstrap Core JavaScript -->
{{ HTML::script("frontend/js/bootstrap.min.js") }}

<!-- Plugin JavaScript -->
{{ HTML::script("http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js") }}
{{ HTML::script("frontend/js/classie.js") }}
{{ HTML::script("frontend/js/cbpAnimatedHeader.js") }}

<!-- Contact Form JavaScript -->
{{ HTML::script("frontend/js/jqBootstrapValidation.js") }}

<!-- Custom Theme JavaScript -->
{{ HTML::script("frontend/js/freelancer.js") }}

@yield('js_foot')

</body>

</html>
