<!DOCTYPE html>
<html data-wf-site="545f56f8c3684d9f25f51d7e" data-wf-page="546203cc80bbb1ac3735af5c">
    <head>
        <meta charset="utf-8">
        <title>import - tgt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="https://y7v4p6k4.ssl.hwcdn.net/placeholder/favicon.ico">
        <meta name="generator" content="Webflow">

        @section('css')
        {{ HTML::style('css/normalize.css') }}
        {{ HTML::style('css/webflow.css') }}
        {{ HTML::style('css/tgt-admin.webflow.css') }}
        @show
        {{ HTML::style('css/custom.css') }}

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
                    <div class="w-col w-col-6 w-col-small-6 w-col-tiny-6 left-nav">
                        <a class="w-inline-block" href="index.html"><img class="logo" src="{{ URL::asset('images/1415577731_handdrawn-lightbulb-48.png') }}" alt="545faced7848976b2dd62a5e_1415577731_handdrawn-lightbulb-48.png">
                            <div class="brand"><em class="head text logo">TGT<br></em>
                            </div>
                        </a>
                    </div>
                    <div class="w-col w-col-6 w-col-small-6 w-col-tiny-6 right-nav">
                        <div class="w-row">
                            <div class="w-col w-col-3 w-col-small-3 w-col-tiny-6"><img class="head col noti" src="{{ URL::asset('https://d3e54v103j8qbb.cloudfront.net/img/image-placeholder.svg') }}" alt="image-placeholder.svg">
                            </div>
                            <div class="w-col w-col-3 w-col-small-3 w-col-tiny-6"><img class="head col noti" src="{{ URL::asset('https://d3e54v103j8qbb.cloudfront.net/img/image-placeholder.svg') }}" alt="image-placeholder.svg">
                            </div>
                            <div class="w-col w-col-3 w-col-small-3 w-col-tiny-6 w-hidden-tiny"><img class="head col noti" src="{{ URL::asset('https://d3e54v103j8qbb.cloudfront.net/img/image-placeholder.svg') }}" alt="image-placeholder.svg">
                            </div>
                            <div class="w-col w-col-3 w-col-small-3 w-col-tiny-6 w-hidden-tiny"><img class="head col noti" src="{{ URL::asset('https://d3e54v103j8qbb.cloudfront.net/img/image-placeholder.svg') }}" alt="image-placeholder.svg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-nav menubar" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
            <div class="w-container head col noti">
                <nav class="w-nav-menu w-clearfix left" role="navigation"><a class="w-nav-link navlink" href="#">Dashboard</a><a class="w-nav-link navlink" href="#">Import/Export</a><a class="w-nav-link navlink" href="#">Report</a><a class="w-nav-link navlink" href="#">EntryData</a><a class="w-nav-link navlink" href="#">Search</a><a class="w-nav-link navlink" href="#">Validation</a><a class="w-nav-link navlink" href="#">Camp</a><a class="w-nav-link navlink" href="#">Setting</a>
                </nav>
                <div class="w-nav-button menu_button">
                    <div class="w-icon-nav-menu"></div>
                </div>
            </div>
        </div>
        
        @yield('content')
        
        <div class="social-section">
            <div class="w-container">
                <div class="footer text">© 2014&nbsp;The Gifted and Talented Foundation. All Rights Reserved.</div>
            </div>
        </div>
        @section('js_foot')
        {{ HTML::script('js/jquery.min.js') }}
        <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
        @show
    </body>
</html>