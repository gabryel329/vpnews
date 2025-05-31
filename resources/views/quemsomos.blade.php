@extends('layouts.app')
@section('content')
    <br>
    @php
        $configuracao = \App\Models\ConfiguracaoSite::first();
        $times = \App\Models\Time::all();
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
                @foreach($times->chunk(3) as $timeChunk)
                    @foreach($timeChunk as $time)
                        <div class="col-sm-6 col-lg-4 wow fadeInLeft" data-wow-delay=".2s" data-wow-duration="1s">
                            <!-- Team Modern-->
                            <article class="team-modern">
                                <a class="team-modern-figure" href="#">
                                    <img src="images/{{$time->foto}}" alt="" width="270" height="236" />
                                </a>
                                <div class="team-modern-caption">
                                    <h6 class="team-modern-name"><a href="#">{{$time->nome}}</a></h6>
                                    <div class="team-modern-status">{{$time->obs}}</div>
                                    <ul class="list-inline team-modern-social-list">
                                        <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                                        <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                                        <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                                        <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
                                    </ul>
                                </div>
                            </article>
                        </div>
                    @endforeach
                    </div><div class="row row-lg row-40 justify-content-center">
                @endforeach
            </div>
        </div>
    </section>
@endsection
