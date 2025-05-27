@extends('layouts.app')
@section('content')
    <br>
    @php
        $configuracao = \App\Models\ConfiguracaoSite::first();
    @endphp
    <section class="section section-lg bg-default">
        <div class="container">
            <div class="tabs-custom row row-50 justify-content-center flex-lg-row-reverse text-center text-md-left"
                id="tabs-4">
                <div class="col-lg-12 col-xl-9">
                    <!-- Tab panes-->
                    <div class="tab-content tab-content-1">
                        <div class="tab-pane fade show active text-center" id="tabs-4-1">
                            <h4>Sobre nós</h4>
                            <p>{{$configuracao->sobre1}}</p>
                            <p>{{$configuracao->sobre2}}</p>
                            <img src="{{ asset('images/' . $configuracao->logo) }}" alt="Sobre VPnews" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <br>

    <!-- Our Team-->
    <section class="section section-lg section-bottom-md-70 bg-default">
        <div class="container">
            <h3 class="oh"><span class="d-inline-block wow slideInUp" data-wow-delay="0s">Nosso Time</span></h3>
            <div class="row row-lg row-40 justify-content-center">
                <div class="col-sm-6 col-lg-4 wow fadeInLeft" data-wow-delay=".2s" data-wow-duration="1s">
                    <!-- Team Modern-->
                    <article class="team-modern"><a class="team-modern-figure" href="#"><img
                                src="images/ocimar.png" alt="" width="270" height="236" /></a>
                        <div class="team-modern-caption">
                            <h6 class="team-modern-name"><a href="#">Marzzo Silva</a></h6>
                            <div class="team-modern-status">Apresentador</div>
                            <ul class="list-inline team-modern-social-list">
                                <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                                <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                                <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                                <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
                            </ul>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6 col-lg-4 wow fadeInLeft" data-wow-delay="0s" data-wow-duration="1s">
                    <!-- Team Modern-->
                    <article class="team-modern"><a class="team-modern-figure" href="#"><img
                                src="images/fabio.png" alt="" width="270" height="236" /></a>
                        <div class="team-modern-caption">
                            <h6 class="team-modern-name"><a href="#">Phabio Almeida</a></h6>
                            <div class="team-modern-status">Comentárista</div>
                            <ul class="list-inline team-modern-social-list">
                                <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                                <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                                <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                                <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
                            </ul>
                        </div>
                    </article>
                </div>
                {{-- <div class="col-sm-6 col-lg-3 wow fadeInRight" data-wow-delay=".1s" data-wow-duration="1s">
                    <!-- Team Modern-->
                    <article class="team-modern"><a class="team-modern-figure" href="#"><img
                                src="images/victor.png" alt="" width="270" height="236" /></a>
                        <div class="team-modern-caption">
                            <h6 class="team-modern-name"><a href="#">Victor Lisboa</a></h6>
                            <div class="team-modern-status">Diretor</div>
                            <ul class="list-inline team-modern-social-list">
                                <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                                <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                                <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                                <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
                            </ul>
                        </div>
                    </article>
                </div> --}}
                <div class="col-sm-6 col-lg-4 wow fadeInRight" data-wow-delay=".3s" data-wow-duration="1s">
                    <!-- Team Modern-->
                    <article class="team-modern"><a class="team-modern-figure" href="#"><img
                                src="images/rafael.png" alt="" width="270" height="236" /></a>
                        <div class="team-modern-caption">
                            <h6 class="team-modern-name"><a href="#">Rafael</a></h6>
                            <div class="team-modern-status">Produtor</div>
                            <ul class="list-inline team-modern-social-list">
                                <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                                <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                                <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                                <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
                            </ul>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
