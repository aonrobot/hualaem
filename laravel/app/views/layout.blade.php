<!DOCTYPE html>
<html lang="th" data-wf-site="545f56f8c3684d9f25f51d7e" >
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="https://y7v4p6k4.ssl.hwcdn.net/placeholder/favicon.ico">
        <meta name="generator" content="Webflow">

        @section('css')
        {{ HTML::style('css/normalize.css') }}
        {{ HTML::style('css/webflow.css') }}
        {{ HTML::style('css/tgt-admin.webflow.css') }}
        @show

        @section('js_head')
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
        <script>
WebFont.load({
    google: {
        families: ["Ubuntu:300,300italic,400,400italic,500,500italic,700,700italic", "PT Sans:400,400italic,700,700italic", "Roboto:300,regular", "Roboto Condensed:regular"]
    }
});
        </script>
        {{ HTML::script('js/modernizr.js'); }}
        @show

    </head>
    <body>
        <div class="navbar">
            <div class="w-container">
                <div class="w-row">
                    <div class="w-col w-col-6 left-nav">
                        <a class="w-inline-block" href="index.html"><img class="logo" src="{{ URL::asset('images/1415577731_handdrawn-lightbulb-48.png') }}" alt="545faced7848976b2dd62a5e_1415577731_handdrawn-lightbulb-48.png">
                            <div class="brand"><em class="head text logo">TGT |<br></em>
                            </div>
                        </a>
                    </div>
                    <div class="w-col w-col-6 right-nav">
                        <div class="w-form">

                            <!-- Form for login-->

                            <form id="email-form" name="login-form" data-name="Login Form">
                                <div class="w-row">
                                    <div class="w-col w-col-4">
                                        <div class="w-clearfix"><img class="icon _48" src="{{ URL::asset('images/1415840683_user-32.png') }}" alt="5463af9714d72b9b0fb5a9c1_1415840683_user-32.png">
                                        </div>
                                        <div class="w-clearfix"><img class="icon _48" src="{{ URL::asset('images/1415840688_lock-open-32.png') }}" alt="5463afee895960d5616d9d09_1415840688_lock-open-32.png">
                                        </div>
                                    </div>
                                    <div class="w-col w-col-4">
                                        <div>
                                            <input class="w-input" id="username" type="text" placeholder="Username" name="username" required="required" autofocus="autofocus" data-name="username">
                                        </div>
                                        <div>
                                            <input class="w-input" id="password" type="password" placeholder="Password" name="password" required="required" data-name="password">
                                        </div><a class="link forget_pass" href="#">Forget Password</a>
                                    </div>
                                    <div class="w-col w-col-4 w-hidden-tiny">
                                        <div class="w-clearfix">
                                            <input class="w-button button green signup" type="button" value="Sign Up">
                                        </div>
                                        <div class="w-clearfix">
                                            <input class="w-button button blue signin" type="submit" value="Sign In">
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- Form for login-->

                            <div class="w-form-done"></div>
                            <div class="w-form-fail"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-nav menubar" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
            <div class="w-container">
                <nav class="w-nav-menu w-clearfix left" role="navigation"><a class="w-nav-link navlink" href="#">Dashboard</a><a class="w-nav-link navlink" href="#">Calendar</a><a class="w-nav-link navlink" href="#">Profile</a>
                </nav>
                <nav class="w-nav-menu w-clearfix right" role="navigation"><a class="w-nav-link navlink" href="#">Register Camp</a>
                </nav>
                <div class="w-nav-button menu_button">
                    <div class="w-icon-nav-menu"></div>
                </div>
            </div>
        </div>
        <div class="div slide">
            <div class="w-slider slider" data-animation="slide" data-duration="500" data-infinite="1">
                <div class="w-slider-mask">
                    <div class="w-slide"></div>
                    <div class="w-slide"></div>
                </div>
                <div class="w-slider-arrow-left">
                    <div class="w-icon-slider-left"></div>
                </div>
                <div class="w-slider-arrow-right">
                    <div class="w-icon-slider-right"></div>
                </div>
                <div class="w-slider-nav w-round"></div>
            </div>
        </div>
        <div class="section blue" data-anchor="slide1">
            <div class="w-container">
                <h1 class="heading index _1">มูลนิธิหัวแหลมเพื่อสังคม<br>The Gifted and Talented Foundation</h1>
                <h1 class="heading index _2">“ เป็นคนดี มีปัญญา สร้างคุณประโยชน์ “</h1>
            </div>
        </div>
        <div class="section">
            @yield('content')
        </div>
        <div class="social-section">
            <div class="w-container">
                <div class="footer text">© 2014&nbsp;The Gifted and Talented Foundation. All Rights Reserved.</div>
            </div>
        </div>
        @section('js_foot')
        {{ HTML::script('js/jquery.min.js') }}
        {{ HTML::script('js/webflow.js') }}
        <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
        @show
    </body>
</html>