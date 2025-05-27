@php
        $configuracao = \App\Models\ConfiguracaoSite::first();
    @endphp
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 fh5co_padding_menu">
                <img src="{{ asset('images/' . $configuracao->logo) }}" alt="img" class="fh5co_logo_width"/>
            </div>
            <div class="col-12 col-md-9 align-self-center fh5co_mediya_right">
                <div class="text-center d-inline-block">
                    <a class="fh5co_display_table" href="{{ $configuracao->instagram }}" target="_blank"><div class="fh5co_verticle_middle"><i class="fa fa-instagram"></i></i></div></a>
                </div>
                {{-- <div class="text-center d-inline-block">
                    <a class="fh5co_display_table" href="{{ asset('https://www.youtube.com/@tvvermelhoepreto.oficial')}}" target="_blank"><div class="fh5co_verticle_middle"><i class="fa fa-brands fa-youtube"></i></i></div></a>
                </div> --}}
                {{-- <div class="text-center d-inline-block">
                    <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="https://twitter.com/fh5co" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="https://fb.com/fh5co" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div></a>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        <nav class="navbar navbar-toggleable-md navbar-light ">
            <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
            <a class="navbar-brand" href="/"><img src="{{ asset('images/' . $configuracao->logo) }}" alt="img" class="mobile_logo_width"/></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('NoticiasIndex') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('NoticiasIndex') }}">Noticias <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('QuemSomosIndex') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('QuemSomosIndex') }}">Quem Somos <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('ContatoIndex') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('ContatoIndex') }}">Contato <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('ContatoIndex') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('ContatoIndex') }}">Agendamento <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>