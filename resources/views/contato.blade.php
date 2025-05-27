@extends('layouts.app')
@section('content')
<div class="container-fluid  fh5co_fh5co_bg_contcat">
    @php
        $configuracao = \App\Models\ConfiguracaoSite::first();
    @endphp
    <div class="container">
        <div class="row py-4">
            <div class="col-md-6 py-3">
                <div class="row fh5co_contact_us_no_icon_difh5co_hover">
                    <div class="col-3 fh5co_contact_us_no_icon_difh5co_hover_1">
                        <div class="fh5co_contact_us_no_icon_div"> <span><i class="fa fa-phone"></i></span> </div>
                    </div>
                    <div class="col-9 align-self-center fh5co_contact_us_no_icon_difh5co_hover_2">
                        <span class="c_g d-block">Telefone</span>
                        <span class="d-block c_g fh5co_contact_us_no_text">{{$configuracao->telefone}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="row fh5co_contact_us_no_icon_difh5co_hover">
                    <div class="col-3 fh5co_contact_us_no_icon_difh5co_hover_1">
                        <div class="fh5co_contact_us_no_icon_div"> <span><i class="fa fa-envelope"></i></span> </div>
                    </div>
                    <div class="col-9 align-self-center fh5co_contact_us_no_icon_difh5co_hover_2">
                        <span class="c_g d-block">E-mail</span>
                        <span class="d-block c_g fh5co_contact_us_no_text">{{$configuracao->email}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="container-fluid mb-4">
    <div class="container">
        <div class="col-12 text-center contact_margin_svnit ">
            <div class="text-center fh5co_heading py-2">Contato</div>
        </div>
        <div class="row">
            {{-- <div class="col-12 col-md-6">
                <form class="row" id="fh5co_contact_form">
                    <div class="col-12 py-3">
                        <input type="text" class="form-control fh5co_contact_text_box" placeholder="Nome" />
                    </div>
                    <div class="col-6 py-3">
                        <input type="text" class="form-control fh5co_contact_text_box" placeholder="E-mail" />
                    </div>
                    <div class="col-6 py-3">
                        <input type="text" class="form-control fh5co_contact_text_box" placeholder="Assunto" />
                    </div>
                    <div class="col-12 py-3">
                        <textarea class="form-control fh5co_contacts_message" placeholder="Messagem"></textarea>
                    </div>
                    <div class="col-12 py-3 text-center"> <a href="#" class="btn contact_btn">Enviar</a> </div>
                </form>
            </div> --}}
            <div class="col-12 col-md-12 align-self-center">
                <iframe src="{{$configuracao->localizacao}}" width="1100" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
