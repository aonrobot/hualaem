<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="{{ URL::to('/') }}/">
        
        @section('css')
            {{ HTML::style('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
            {{ HTML::style('backend/bower_components/metisMenu/dist/metisMenu.min.css') }}
            {{ HTML::style('backend/dist/css/timeline.css') }}
            {{ HTML::style('backend/dist/css/sb-admin-2.css') }}
            {{ HTML::style('backend/bower_components/font-awesome/css/font-awesome.min.css') }}
        @show
        {{ HTML::style('backend/css/custom.css') }}

        @section('js_head')

        @show

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::to('/admin') }}">Hualaem</a>
                </div>
                <!-- /.navbar-header -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="{{ URL::to('/admin') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.user.list') }}"><i class="fa fa-users fa-fw"></i> User</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-university fa-fw"></i> Camp<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.camp.add') }}">Add</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.camp.list') }}">List</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-newspaper-o fa-fw"></i> News<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.news.add') }}">Add</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.news.list') }}">List</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="{{ route('admin.search.user') }}"><i class="fa fa-search fa-fw"></i> Search</a>
                            </li>
                            <li>
                                <a href="{{ URL::action('mix5003\Hualaem\Backend\ImportUserController@getStep1') }}">
                                    <i class="fa fa-upload fa-fw"></i>
                                    Import
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
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



        </div>


        @section('js_foot')
        {{ HTML::script('backend/bower_components/jquery/dist/jquery.min.js') }}
        {{ HTML::script('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
        {{ HTML::script('backend/bower_components/metisMenu/dist/metisMenu.min.js') }}
        {{ HTML::script('backend/dist/js/sb-admin-2.js') }}

        <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
        @show
    </body>
</html>