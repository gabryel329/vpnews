<html lang="en" class="no-js">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>VPnews</title>
    <link rel="icon" type="image/png" href="{{ asset('images/white_logo.png') }}">
    <link href="{{ asset('css/media_query.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('css/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Poppins') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/owl.theme.default.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/style_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- Modernizr JS -->
    <script src="{{ asset('js/modernizr-3.5.0.min.js') }}"></script>
    @stack('css')
</head>

<body style="                                                                 background: -webkit-linear-gradient(130deg, #d10000,#000000,#292929);/* Chrome 10-25, Safari 5.1-6 */                          background: linear-gradient(130deg, #d10000,#000000,#292929);/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */                                             ">
    @php
        @session_start();
    @endphp

    @include('layouts.header')

    @yield('content')
    
    <div class="container-fluid fh5co_footer_bg pb-3">
        <div class="container animate-box">
            <div class="row">
                <div class="col-12 spdp_right py-3"><img src="{{ asset('images/logo.png')}}" alt="img"
                        class="footer_logo" /></div>
                <div class="col-md-12">
                    <div class="footer_main_title py-3"> Sobre</div>
                    <div class="footer_sub_about pb-3"> Bem-vindo ao TV Vermelho e Preto News (VPnews), o seu portal de
                        notícias dedicado ao Esporte Clube Vitória! Aqui, você encontrará as últimas atualizações, análises,
                        entrevistas e tudo o que envolve o universo do nosso querido Leão da Barra. Seja você torcedor de
                        longa data ou novo fã, o VPnews é o lugar certo para ficar por dentro de tudo que acontece no
                        Vitória. Acompanhe-nos e torça junto com a gente!
                    </div>
                    <div class="footer_mediya_icon">
                        <div class="text-center d-inline-block">
                            <a class="fh5co_display_table" href="https://www.instagram.com/tvvermelhoepreto/" target="_blank"><div class="fh5co_verticle_middle"><i class="fa fa-instagram"></i></i></div></a>
                        </div>
                        <div class="text-center d-inline-block">
                            <a class="fh5co_display_table" href="https://www.youtube.com/@tvvermelhoepreto.oficial" target="_blank"><div class="fh5co_verticle_middle"><i class="fa fa-brands fa-youtube"></i></i></div></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid fh5co_footer_right_reserved">
        <div class="container">
            <div class="row  ">
                <div class="col-12 col-md-6 py-4 Reserved"> © Copyright 2018, A&B Entertainment and Business. </div>
            </div>
        </div>
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
    </div>
    
    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous">
    </script>-->
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js') }}"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
    </script>
    <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js') }}"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous">
    </script>
    <!-- Waypoints -->
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <!-- Parallax -->
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <!-- Main -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>if (!navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i)){$(window).stellar();}</script>
</body>

</html>
