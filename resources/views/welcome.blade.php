@extends('layouts.app')
<style>
    .fh5co_news_img {
        position: relative;
    }

    .fh5co_news_img img {
        width: 100%;
        height: auto;
    }

    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2rem;
        color: white;
        text-decoration: none;
        border-radius: 50%;
        padding: 0.5rem;
    }

    .play-button i {
        position: relative;
        top: -2px;
    }

    .item {
        margin-bottom: 1rem;
    }

    .fh5co_small_post_heading {
        font-size: 1rem;
        color: #333;
    }

    .fh5co_small_post_heading:hover {
        text-decoration: underline;
    }

    .c_g {
        font-size: 0.875rem;
        color: #666;
    }

    .cell-top-four {
        background-color: hsl(217, 72%, 45%, 0.5) !important;
        color: #fff;
    }

    .cell-middle-two {
        background-color: rgba(208, 112, 38, 0.5) !important;
        color: #fff;
    }

    .cell-middle-seven {
        background-color: hsla(136, 72%, 43%, 0.5) !important;
        color: #fff;
    }

    .cell-bottom-four {
        background-color: hsl(6, 80%, 46%, 0.5) !important;
        color: #fff;
    }

    .color-box {
        width: 15px;
        height: 15px;
        display: inline-block;
        vertical-align: middle;
        margin-right: 5px;
    }

    .highlight {
        background-color: rgba(255, 255, 20, 0.493) !important;
    }

    .black-text {
        color: black;
    }
</style>
@section('content')
    <div class="container-fluid paddding mb-5">
        <div class="row mx-0">
            @if ($artigos->count() > 0)
                {{-- Exibir o artigo mais recente --}}
                <div class="col-md-6 col-12 paddding animate-box" data-animate-effect="fadeIn">
                    @php
                        $artigoRecente = $artigos->first();
                    @endphp
                    <div class="fh5co_suceefh5co_height">
                        <img src="{{ asset('images/' . $artigoRecente->imagem) }}" alt="img" />
                        <div class="fh5co_suceefh5co_height_position_absolute"></div>
                        <div class="fh5co_suceefh5co_height_position_absolute_font">
                            <div class="">
                                <a href="{{ route('NoticiasShow', $artigoRecente->id) }}" class="color_fff">
                                    <i
                                        class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $artigoRecente->created_at->format('d/m/Y') }}
                                </a>
                            </div>
                            <div class="">
                                <a href="{{ route('NoticiasShow', $artigoRecente->id) }}" class="fh5co_good_font">
                                    {{ $artigoRecente->titulo }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Exibir os outros artigos --}}
                <div class="col-md-6">
                    <div class="row">
                        @foreach ($artigos->slice(1) as $artigo)
                            <div class="col-md-6 col-6 paddding animate-box" data-animate-effect="fadeIn">
                                <div class="fh5co_suceefh5co_height_2">
                                    <img src="{{ asset('images/' . $artigo->imagem) }}" alt="img" />
                                    <div class="fh5co_suceefh5co_height_position_absolute"></div>
                                    <div class="fh5co_suceefh5co_height_position_absolute_font_2">
                                        <div class="">
                                            <a href="{{ route('NoticiasShow', $artigo->id) }}" class="color_fff">
                                                <i
                                                    class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $artigo->created_at->format('d/m/Y') }}
                                            </a>
                                        </div>
                                        <div class="">
                                            <a href="{{ route('NoticiasShow', $artigo->id) }}" class="fh5co_good_font_2">
                                                {{ $artigo->titulo }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- <div class="container-fluid fh5co_video_news_bg pb-4">
        <div class="container animate-box" data-animate-effect="fadeIn">
            <div>
                <div class="fh5co_heading fh5co_heading_border_bottom pt-5 pb-2 mb-4">Lives</div>
            </div>
            <div>
                <div class="owl-carousel owl-theme" id="slider3">
                    @foreach ($lives as $item)
                        <div class="item px-2">
                            <div class="fh5co_hover_news_img">
                                <div class="position-relative">
                                    <!-- Imagem do Vídeo com Botão de Play -->
                                    <div class="fh5co_news_img">
                                        <img src="images/{{ $item->imagem }}" alt="Imagem do vídeo" class="img-fluid" />
                                        <a href="{{ $item->link }}" class="play-button" target="_blank">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                    <!-- Título e Data -->
                                    <div class="pt-2">
                                        <a href="{{ $item->link }}" target="_blank"
                                            class="d-block fh5co_small_post_heading">
                                            <span>{{ $item->titulo }}</span>
                                        </a>
                                        <div class="c_g"><i
                                                class="fa fa-clock-o"></i>{{ $item->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid pt-3">
        <div class="container animate-box" data-animate-effect="fadeIn">
            <div>
                <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Trending</div>
            </div>
            <div class="owl-carousel owl-theme js" id="slider1">
                @foreach ($trending as $item)
                    <div class="item px-2">
                        <div class="fh5co_latest_trading_img_position_relative">
                            <div class="fh5co_latest_trading_img">
                                <img src="images/{{ $item->imagem }}" alt="" class="fh5co_img_special_relative" />
                            </div>
                            <div class="fh5co_latest_trading_img_position_absolute"></div>
                            <div class="fh5co_latest_trading_img_position_absolute_1">
                                <a href="{{ $item->link }}" target="_blank" class="text-white">
                                    {{ $item->titulo }}
                                </a>
                                <div class="fh5co_latest_trading_date_and_name_color">
                                    {{ $item->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid pb-4 pt-5">
        <div class="container animate-box">
            <div>
                <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Noticias</div>
            </div>
            <div class="owl-carousel owl-theme" id="slider2">
                @foreach ($artigos2 as $item)
                    <div class="item px-2">
                        <div class="fh5co_hover_news_img">
                            <div class="fh5co_news_img"><img src="images/{{ $item->imagem }}" alt="" /></div>
                            <div>
                                <a href="{{ route('NoticiasShow', $item->id) }}"
                                    class="d-block fh5co_small_post_heading"><span class="">
                                        {{ $item->titulo }}</span></a>
                                <div class="c_g"><i class="fa fa-clock-o"></i> {{ $item->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- <div class="container-fluid pb-4 pt-4 paddding">
        <div class="container paddding">
            <div class="row mx-0">
                <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                    <div>
                        <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Classificação</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th colspan="2">TIMES</th>
                                    <th>P</th>
                                    <th>J</th>
                                    <th>V</th>
                                    <th>E</th>
                                    <th>D</th>
                                    <th>GP</th>
                                    <th>GC</th>
                                    <th>SG</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $index => $row)
                                    @if ($index != 0)
                                        <tr id="team-{{ $index }}" data-time="{{ trim($row[1]) }}"
                                            onclick="selectTeam('{{ $index }}', '{{ trim($row[1]) }}')">
                                            <td
                                                class="@if ($index >= 1 && $index <= 4) cell-top-four
                                            @elseif($index >= 5 && $index <= 6)
                                                cell-middle-two
                                            @elseif($index >= 7 && $index <= 12)
                                                cell-middle-seven       
                                            @elseif($index > 16) cell-bottom-four @endif @if (isset($teamName) && $teamName == trim($row[1])) highlight @endif">
                                                {{ $index }}
                                            </td>
                                            <td class="@if (isset($teamName) && $teamName == trim($row[1])) highlight @endif">
                                                <img src="images/{{ trim($row[1]) }}.png"
                                                    style="height: 25px; vertical-align: middle; margin-right: 5px;">
                                            </td>
                                            <td class="@if (isset($teamName) && $teamName == trim($row[1])) highlight @endif text-start">
                                                @if (trim($row[1]) == 'Sao Paulo')
                                                    São Paulo
                                                @elseif(trim($row[1]) == 'Cuiaba')
                                                    Cuiabá
                                                @elseif(trim($row[1]) == 'Atletico-MG')
                                                    Atlético-MG
                                                @elseif(trim($row[1]) == 'Atletico-GO')
                                                    Atlético-GO
                                                @elseif(trim($row[1]) == 'Vitoria')
                                                    Vitória
                                                @elseif(trim($row[1]) == 'Gremio')
                                                    Grêmio
                                                @elseif(trim($row[1]) == 'Criciuma')
                                                    Criciúma
                                                @elseif(trim($row[1]) == 'Red Bull Bragantino')
                                                    Bragantino
                                                @else
                                                    {{ trim($row[1]) }}
                                                @endif
                                            </td>
                                            @foreach ($row as $cell_index => $cell)
                                                @if ($cell_index != 1)
                                                    <td class="@if (isset($teamName) && $teamName == trim($row[1])) highlight @endif">
                                                        {{ $cell }}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <td colspan="3">
                                        <div class="color-box" style="background-color:#2161c7"></div>
                                        Libertadores
                                    </td>
                                    <td colspan="3">
                                        <div class="color-box" style="background-color:#d07026"></div>
                                        Pré-Libertadores
                                    </td>
                                    <td colspan="3">
                                        <div class="color-box" style="background-color:#1fbe4a"></div>
                                        Sul-Americana
                                    </td>
                                    <td colspan="4">
                                        <div class="color-box" style="background-color:#d42a18"></div>
                                        Rebaixamento
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-4 animate-box" data-animate-effect="fadeInRight">
                    <div>
                        <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Resultados</div>
                    </div>
                    <div class="clearfix"></div>
                    @if ($rodadasContent)
                        <div class="card mt-4">
                            <div class="card-body black-text">
                                {!! preg_replace_callback(
                                    '/<li class="table__games__item">(.*?)<\/li>/s',
                                    function ($matches) {
                                        $content = $matches[1];
                                
                                        // Remover todos os hrefs e manter as tags de imagem
                                        $content = preg_replace('/<a[^>]*href="[^"]*"[^>]*>/', '', $content);
                                        $content = str_replace('</a>', '', $content);
                                
                                        // Remover as abreviações dos times, mantendo apenas as imagens
                                        $content = preg_replace('/<a[^>]*class="team-link"[^>]*>(.*?)<\/a>/s', '', $content);
                                
                                        // Extrair a data e local
                                        $dateLocation = '';
                                        if (preg_match('/<span class="date">(.*?)<\/span>/s', $content, $dateLocationMatch)) {
                                            $dateLocation = trim($dateLocationMatch[1]);
                                        }
                                
                                        // Extrair time da casa
                                        $homeTeam = '';
                                        if (preg_match('/<span class="home">(.*?)<\/span>/s', $content, $homeTeamMatch)) {
                                            $homeTeam = trim($homeTeamMatch[1]);
                                        }
                                
                                        // Extrair time visitante
                                        $guestTeam = '';
                                        if (preg_match('/<span class="guest">(.*?)<\/span>/s', $content, $guestTeamMatch)) {
                                            $guestTeam = trim($guestTeamMatch[1]);
                                        }
                                
                                        // Extrair o placar
                                        $homeScore = '';
                                        $guestScore = '';
                                        if (preg_match('/<span class="score__home">(.*?)<\/span>/s', $content, $homeScoreMatch)) {
                                            $homeScore = trim($homeScoreMatch[1]);
                                        }
                                        if (preg_match('/<span class="score__guest">(.*?)<\/span>/s', $content, $guestScoreMatch)) {
                                            $guestScore = trim($guestScoreMatch[1]);
                                        }
                                
                                        // Extrair o local do jogo
                                        $location = '';
                                        if (preg_match('/<span class="sep">•<\/span>(.*?)<\/span>/s', $content, $locationMatch)) {
                                            $location = trim($locationMatch[1]);
                                        }
                                
                                        // Montar o layout final utilizando divs
                                        return '
                                                <div class="game-item" style="margin-bottom: 20px;">
                                                    <div style="text-align: center; font-size: 12px; margin-bottom: 5px;">' .
                                            $dateLocation .
                                            ' • ' .
                                            $location .
                                            '</div>
                                                    <div style="display: flex; justify-content: center; align-items: center; gap: 20px;">
                                                        <div style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                                                            ' .
                                            $homeTeam .
                                            '
                                                        </div>
                                                        <div style="display: flex; align-items: center; font-size: 24px; font-weight: bold; text-align: center;">
                                                            <span>' .
                                            $homeScore .
                                            '</span>
                                                            <span style="margin: 0 10px;">X</span>
                                                            <span>' .
                                            $guestScore .
                                            '</span>
                                                        </div>
                                                        <div style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                                                            ' .
                                            $guestTeam .
                                            '
                                                        </div>
                                                    </div>
                                                </div>';
                                    },
                                    $rodadasContent,
                                ) !!}
                            </div>
                        </div>
                    @else
                        <p>Não foi possível carregar as informações da rodada.</p>
                    @endif



                </div>
            </div>
        </div>
    </div> --}}

@endsection
