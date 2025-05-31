@extends('layouts.app')
<style>
    .pagination .page-link {
    background-color: grey; /* Fundo vermelho */
    color: black; /* Texto preto */
    border-color: grey; /* Borda vermelha */
}

.pagination .page-link:hover {
    background-color: lightgray; /* Fundo vermelho escuro ao passar o mouse */
    color: white; /* Texto branco ao passar o mouse */
    border-color: lightgray; /* Borda vermelho escuro ao passar o mouse */
}

.pagination .page-item.active .page-link {
    background-color: grey; /* Fundo vermelho */
    border-color: grey; /* Borda vermelha */
    color: black; /* Texto preto */
}
</style>

@section('content')
    <br>
    <div class="container-fluid pb-4 pt-4 paddding">
        <div class="container paddding">
            <div class="row mx-0">
                <div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
                    <div>
                        <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Notícias</div>
                    </div>
                    @foreach($noticias as $noticia)
                        <div class="row pb-4">
                            <div class="col-md-5">
                                <div class="fh5co_hover_news_img">
                                    <div class="fh5co_news_img"><img src="images/{{$noticia->imagem}}" alt=""/></div>
                                </div>
                            </div>
                            <div class="col-md-7 animate-box">
                                <a href="{{ route('NoticiasShow', $noticia->id) }}" class="fh5co_magna py-2"> {{$noticia->titulo}}</a>
                                <br>
                                <p class="fh5co_mini_time py-3"> {{ $noticia->created_at->format('d/m/Y') }}</p>
                                <div class="fh5co_consectetur"> {{$noticia->descricao}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
            
        <div class="d-flex justify-content-center">
            {{ $noticias->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
