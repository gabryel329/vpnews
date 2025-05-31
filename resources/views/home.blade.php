@extends('layouts.admin')

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <!-- Seção de Artigos -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Novo Artigo</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('artigos.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="titulo">Título</label>
                                        <input class="form-control" id="titulo" name="titulo" type="text" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="imagem">Imagem</label>
                                        <input class="form-control" id="imagem" name="imagem" type="file" required>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="form-label" for="descricao">Descrição</label>
                                    <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Lista de Artigos</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">#</th>
                                        <th style="width: 45%;">Título</th>
                                        <th style="width: 20%;">Editar</th>
                                        <th style="width: 25%;">Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($artigos as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->titulo }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id }}">
                                                    Editar
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $item->id }}">
                                                    Excluir
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal de Exclusão -->
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">
                                                            Confirmar Exclusão</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Tem certeza de que deseja excluir?</strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('artigos.destroy', $item->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal de Edição -->
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">
                                                            Editar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('artigos.update', $item->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="titulo{{ $item->id }}"
                                                                    class="form-label">Título</label>
                                                                <input type="text" class="form-control"
                                                                    id="titulo{{ $item->id }}" name="titulo"
                                                                    value="{{ $item->titulo }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="imagem{{ $item->id }}"
                                                                    class="form-label">Imagem</label>
                                                                <input type="file" class="form-control"
                                                                    id="imagem{{ $item->id }}" name="imagem">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="descricao{{ $item->id }}"
                                                                    class="form-label">Descrição</label>
                                                                <textarea class="form-control" id="descricao{{ $item->id }}" name="descricao" rows="5" required>{{ $item->descricao }}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Salvar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Links de Paginação -->
                            <div class="d-flex justify-content-center">
                                {{ $artigos->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <!-- Seção de Trending -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Nova Trending</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('trending.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="tituloTrending">Título</label>
                                        <input class="form-control" id="tituloTrending" name="titulo" type="text"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="imagemTrending">Imagem</label>
                                        <input class="form-control" id="imagemTrending" name="imagem" type="file"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="form-label" for="link">Link</label>
                                    <input class="form-control" id="link" name="link" type="text" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Lista de Trending</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">#</th>
                                        <th style="width: 45%;">Título</th>
                                        <th style="width: 20%;">Editar</th>
                                        <th style="width: 25%;">Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trending as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->titulo }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#editTrendingModal{{ $item->id }}">
                                                    Editar
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteTrendingModal{{ $item->id }}">
                                                    Excluir
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal de Exclusão -->
                                        <div class="modal fade" id="deleteTrendingModal{{ $item->id }}"
                                            tabindex="-1" aria-labelledby="deleteTrendingModalLabel{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deleteTrendingModalLabel{{ $item->id }}">Confirmar
                                                            Exclusão</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Tem certeza de que deseja excluir?</strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('trending.destroy', $item->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal de Edição -->
                                        <div class="modal fade" id="editTrendingModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editTrendingModalLabel{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editTrendingModalLabel{{ $item->id }}">Editar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('trending.update', $item->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="tituloTrending{{ $item->id }}"
                                                                    class="form-label">Título</label>
                                                                <input type="text" class="form-control"
                                                                    id="tituloTrending{{ $item->id }}" name="titulo"
                                                                    value="{{ $item->titulo }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="imagemTrending{{ $item->id }}"
                                                                    class="form-label">Imagem</label>
                                                                <input type="file" class="form-control"
                                                                    id="imagemTrending{{ $item->id }}"
                                                                    name="imagem">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="link{{ $item->id }}"
                                                                    class="form-label">Link</label>
                                                                <input type="text" class="form-control"
                                                                    id="link{{ $item->id }}" name="link"
                                                                    value="{{ $item->link }}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Salvar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Links de Paginação -->
                            <div class="d-flex justify-content-center">
                                {{ $trending->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row justify-content-center">
                <!-- Seção de Artigos -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Novo Colaborador</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('time.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="nome">Nome</label>
                                        <input class="form-control" id="nome" name="nome" type="text" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="foto">Foto</label>
                                        <input class="form-control" id="foto" name="foto" type="file" required>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="form-label" for="obs">Descrição</label>
                                    <textarea class="form-control" placeholder="Cirugião" id="obs" name="obs" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Lista de Colaboradores</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">#</th>
                                        <th style="width: 45%;">Nome</th>
                                        <th style="width: 20%;">Editar</th>
                                        <th style="width: 25%;">Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($times as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nome }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id }}">
                                                    Editar
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $item->id }}">
                                                    Excluir
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal de Exclusão -->
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">
                                                            Confirmar Exclusão</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Tem certeza de que deseja excluir?</strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('time.destroy', $item->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal de Edição -->
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">
                                                            Editar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('time.update', $item->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="nome{{ $item->id }}"
                                                                    class="form-label">Nome</label>
                                                                <input type="text" class="form-control"
                                                                    id="nome{{ $item->id }}" name="nome"
                                                                    value="{{ $item->nome }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="foto{{ $item->id }}"
                                                                    class="form-label">Foto</label>
                                                                <input type="file" class="form-control"
                                                                    id="foto{{ $item->id }}" name="foto">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="obs{{ $item->id }}"
                                                                    class="form-label">Descrição</label>
                                                                <textarea class="form-control" id="obs{{ $item->id }}" name="obs" rows="5" required>{{ $item->obs }}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Salvar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Links de Paginação -->
                            <div class="d-flex justify-content-center">
                                {{ $times->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <!-- Seção de Lives -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Configuração do Site</div>
                        <div class="card-body">
                            @php
                                $configuracao = $configuracoes->firstWhere('id', 1);
                            @endphp

                            @if ($configuracao)
                                <form method="POST" action="{{ route('configuracao.update', $configuracao->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="icon" class="form-label">Ícone</label>
                                            <input class="form-control" type="file" name="icon" id="icon">
                                            @if ($configuracao->icon)
                                                <small>Atual: <img src="{{ asset('images/' . $configuracao->icon) }}"
                                                        height="40"></small>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nome" class="form-label">Nome</label>
                                            <input class="form-control" type="text" name="nome" id="nome"
                                                value="{{ old('nome', $configuracao->nome) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="logo" class="form-label">Logo</label>
                                            <input class="form-control" type="file" name="logo" id="logo">
                                            @if ($configuracao->logo)
                                                <small>Atual: <img src="{{ asset('images/' . $configuracao->logo) }}"
                                                        height="40"></small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="instagram" class="form-label">Instagram</label>
                                            <input class="form-control" type="text" name="instagram" id="instagram"
                                                value="{{ old('instagram', $configuracao->instagram) }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="whatsapp" class="form-label">Nº Whatsapp</label>
                                            <input class="form-control" placeholder="(00)00000-0000" type="text" name="whatsapp" id="whatsapp"
                                                value="{{ old('whatsapp', $configuracao->whatsapp) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sobre_roda_pe" class="form-label">Texto do Rodapé</label>
                                            <textarea class="form-control" type="text" name="sobre_roda_pe"
                                                id="sobre_roda_pe"
                                                >{{ old('sobre_roda_pe', $configuracao->sobre_roda_pe) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="textonossotime" class="form-label">Cor do Texto "Nosso
                                                Time"</label>
                                            <input class="form-control" type="text" name="textonossotime"
                                                id="textonossotime" placeholder="#FFFFFF"
                                                value="{{ old('textonossotime', $configuracao->textonossotime) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="sobre1" class="form-label">Texto Sobre 1</label>
                                            <textarea class="form-control" type="text" name="sobre1" id="sobre1"
                                                >{{ old('sobre1', $configuracao->sobre1) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sobre1cor" class="form-label">Cor do Sobre 1</label>
                                            <input class="form-control" type="text" name="sobre1cor" id="sobre1cor"
                                                placeholder="#000000"
                                                value="{{ old('sobre1cor', $configuracao->sobre1cor) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="sobre2" class="form-label">Texto Sobre 2</label>
                                            <textarea class="form-control" type="text" name="sobre2" id="sobre2"
                                                >{{ old('sobre2', $configuracao->sobre2) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sobre2cor" class="form-label">Cor do Sobre 2</label>
                                            <input class="form-control" type="text" name="sobre2cor" id="sobre2cor"
                                                placeholder="#000000"
                                                value="{{ old('sobre2cor', $configuracao->sobre2cor) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="telefone" class="form-label">Telefone</label>
                                            <input class="form-control" type="text" name="telefone" id="telefone"
                                                value="{{ old('telefone', $configuracao->telefone) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="text" name="email" id="email"
                                                value="{{ old('email', $configuracao->email) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="localizacao" class="form-label">Localização</label>
                                            <input class="form-control" type="text" name="localizacao"
                                                id="localizacao"
                                                value="{{ old('localizacao', $configuracao->localizacao) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="cor_background" class="form-label">Cor de Fundo
                                                (Background)</label>
                                            <input class="form-control" type="text" name="cor_background"
                                                id="cor_background" placeholder="#FFFFFF"
                                                value="{{ old('cor_background', $configuracao->cor_background) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="corhouve" class="form-label">Cor Hover</label>
                                            <input class="form-control" type="text" name="corhouve" id="corhouve"
                                                placeholder="#CCCCCC"
                                                value="{{ old('corhouve', $configuracao->corhouve) }}">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success w-100">Salvar Configurações</button>
                                </form>
                            @else
                                <div class="alert alert-warning">Configuração com ID 1 não encontrada.</div>
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <!-- Botão para abrir o modal de criação de configuração -->
                @if (!$configuracao)
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createConfigModal">
                        Nova Configuração
                    </button>
                @endif

                <!-- Modal de Criação de Configuração -->
                <div class="modal fade" id="createConfigModal" tabindex="-1" aria-labelledby="createConfigModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('configuracao.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createConfigModalLabel">Nova Configuração</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="icon" class="form-label">Ícone</label>
                                            <input class="form-control" type="file" name="icon" id="icon">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nome" class="form-label">Nome</label>
                                            <input class="form-control" type="text" name="nome" id="nome" value="{{ old('nome') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="logo" class="form-label">Logo</label>
                                            <input class="form-control" type="file" name="logo" id="logo">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="instagram" class="form-label">Instagram</label>
                                            <input class="form-control" type="text" name="instagram" id="instagram" value="{{ old('instagram') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="whatsapp" class="form-label">Nº Whatsapp</label>
                                            <input class="form-control" type="text" name="whatsapp" placeholder="(00)00000-0000" id="whatsapp" value="{{ old('whatsapp') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sobre_roda_pe" class="form-label">Texto do Rodapé</label>
                                            <input class="form-control" type="text" name="sobre_roda_pe" id="sobre_roda_pe" value="{{ old('sobre_roda_pe') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="textonossotime" class="form-label">Cor do Texto "Nosso Time"</label>
                                            <input class="form-control" type="text" name="textonossotime" id="textonossotime" value="{{ old('textonossotime') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="sobre1" class="form-label">Texto Sobre 1</label>
                                            <input class="form-control" type="text" name="sobre1" id="sobre1" value="{{ old('sobre1') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sobre1cor" class="form-label">Cor do Sobre 1</label>
                                            <input class="form-control" type="text" name="sobre1cor" id="sobre1cor" value="{{ old('sobre1cor') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="sobre2" class="form-label">Texto Sobre 2</label>
                                            <input class="form-control" type="text" name="sobre2" id="sobre2" value="{{ old('sobre2') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sobre2cor" class="form-label">Cor do Sobre 2</label>
                                            <input class="form-control" type="text" name="sobre2cor" id="sobre2cor" value="{{ old('sobre2cor') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="telefone" class="form-label">Telefone</label>
                                            <input class="form-control" type="text" name="telefone" id="telefone" value="{{ old('telefone') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="text" name="email" id="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="localizacao" class="form-label">Localização</label>
                                            <input class="form-control" type="text" name="localizacao" id="localizacao" value="{{ old('localizacao') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="cor_background" class="form-label">Cor de Fundo (Background)</label>
                                            <input class="form-control" type="text" name="cor_background" id="cor_background" value="{{ old('cor_background') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="corhouve" class="form-label">Cor Hover</label>
                                            <input class="form-control" type="text" name="corhouve" id="corhouve" value="{{ old('corhouve') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
