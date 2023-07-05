<html>

<head>
    <title>Stayscape</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/uniform.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/blueimp-gallery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing.css') }}">
    <style type="text/css">
        #freecssfooter {
            display: block;
            width: 100%;
            padding: 120px 0 20px;
            overflow: hidden;
            background-color: transparent;
            z-index: 5000;
            text-align: center;
        }

        #freecssfooter div#fcssholder div {
            display: none;
        }

        #freecssfooter div#fcssholder div:first-child {
            display: block;
        }

        #freecssfooter div#fcssholder div:first-child a {
            float: none;
            margin: 0 auto;
        }

    </style>
    <script type="text/javascript" async=""
        src="https://www.googletagmanager.com/gtag/js?id=G-T6JN2QZ2DW&amp;cx=c&amp;_slc=1"></script>
    <script async="" src="//www.google-analytics.com/analytics.js"></script>
    <script type="text/javascript" async="" src="//s3.buysellads.com/ac/bsa.js"></script>
    <script type="text/javascript" id="_bsap_js_b893e54e42ad5b76e7b252f59be18e67"
        src="//s3.buysellads.com/r/s_b893e54e42ad5b76e7b252f59be18e67.js?v=1688576400000" async="async"></script>
    <script type="text/javascript" src="//s3.buysellads.com/ac/pro.js" id="_bsap_premium_pro"></script>
    <script type="text/javascript" id="_bsaPRO_js" src="//srv.buysellads.com/ads/get/ids/CV7DP2T/?r=1688576400000"
        async="async"></script>
</head>

<body id="home" style="">
    <script type="text/javascript">
        (function () {
            var bsa = document.createElement('script');
            bsa.type = 'text/javascript';
            bsa.async = true;
            bsa.src = '//s3.buysellads.com/ac/bsa.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
        })();

    </script>
    <nav class="navbar navbar-default" role="navigation" style="background-color: aliceblue">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" style="background-color: #8DA9C4" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
                <a class="navbar-brand"><img src="{{ asset('logo3.png') }}" alt="logo"
                        style="width:48px; height: 48px"></a></div>
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li style="font-weight: 700; font-size:18px"><a href="/signIn" class="btn">Sign In</a></li>
                    <li style="font-weight: 700; font-size:18px"><a href="/signUp" class="btn">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="banner"><img src="{{ asset('bg_1.jpg') }}" class="img-responsive" alt="bg">
        <div class="welcome-message">
            <div class="wrap-info">
                <div class="information">
                    <h1 class="animated fadeInDown">Stayscape</h1>
                    <p class="animated fadeInUp">Tired of the mundane? Search no further! Dive into our wonderful world
                        of unique lodging options that’ll take your vacation
                        to the next level.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer services wowload fadeInUp animated"
        style="visibility: visible; animation-name: fadeInUp; background-color: aliceblue">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div id="RoomCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item  height-full active"><img src="{{ asset('images/photos/9.jpg') }}"
                                class="img-responsive" alt="website template image"></div>
                        </div>
                    </div>
                    <div class="caption" style="background-color:white">Rooms<a href="" class="pull-right"></a></div>
                </div>
                <div class="col-sm-4">
                    <div id="TourCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item  height-full active"><img src="{{ asset('images/photos/6.jpg') }}"
                                class="img-responsive" alt="website template image"></div>
                        </div>
                    </div>
                    <div class="caption"  style="background-color:white">Tour Packages<a href="" class="pull-right"></a></a></div>
                </div>
                <div class="col-sm-4">
                    <div id="FoodCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item  height-full active"><img src="{{ asset('images/photos/2.jpg') }}"
                                class="img-responsive" alt="website template image"></div>
                        </div>
                    </div>
                    <div class="caption" style="background-color:white">Food and Drinks<a href="pages/gallery.php" class="pull-right"></a></div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <nav class="bottom-navbar">
            <div class="container">
                <p class="footer-text" style="color: white">© 2023 Stayscape Inc. All rights reserved.</p>
                <p class="footer-text" style="color: white"> Magang - LEA</p>
            </div>
        </nav>
    </footer>
</body>

</html>
