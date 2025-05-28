@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row">
        <!-- Coluna esquerda -->
        <div class="col-md-4">
            <!-- Filtro -->
            <div class="card shadow-sm mb-3 p-3">
                <h4 class="mb-3">Filtro de Especialidade</h4>
                <div class="mb-3">
                    <label>Especialidade:</label>
                    <select id="especialidade" class="form-control">
                        @foreach($especialidades as $especialidade)
                            <option value="{{ $especialidade['id'] }}">{{ $especialidade['especialidade'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Profissionais:</label>
                    <select id="profissional" class="form-control" disabled>
                        <option selected disabled>Selecione uma especialidade</option>
                    </select>
                </div>
            </div>

            <!-- Calendário -->
            <div class="card shadow-sm p-3">
                <h5>Selecione a data</h5>
                <div id="calendario"></div>
            </div>
        </div>

        <!-- Coluna direita -->
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {!! session('error') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif
            <div class="card shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Data Selecionada: <span id="dataSelecionada" class="text-danger">--/--/----</span></h5>
                    <button id="btnSalvar" class="btn btn-success" style="display: none;">Salvar</button>
                </div>

                <div class="table-responsive">
                    <form id="formAgendamento" action="{{ route('marcacao.enviar') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="paciente_id" id="paciente_id">
                        <input type="hidden" name="matricula" id="matricula">
                        <input type="hidden" name="data" id="inputDataSelecionada">
                        <input type="hidden" name="profissionalId" id="inputProfissional">
                        <input type="hidden" name="especialidadeId" id="inputEspecialidade">

                        <div class="mb-3">
                            <label for="horario">Horário:</label>
                            <select name="horario" id="selectHorario" class="form-select" required>
                                <option disabled selected>Selecione um horário</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Nome do Paciente:</label>
                            <input type="text" name="paciente" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Celular:</label>
                            <input type="text" name="celular" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Convênio:</label>
                            <select name="convenio" id="convenio" class="form-control" required>
                                <option selected disabled>Carregando convênios...</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Procedimento:</label>
                            <div class="input-group">
                                <input type="text" id="procedimento_nome" class="form-control" placeholder="Selecione um procedimento" readonly required>
                                <input type="hidden" name="procedimento_id" id="procedimento_id">
                                <input type="hidden" name="codigo" id="codigo">
                                <input type="hidden" name="valor_proc" id="valor_proc">
                                <button type="button" class="btn btn-outline-primary" onclick="abrirModalProcedimento()">Buscar</button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Agendar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="procedimentoModal" tabindex="-1" aria-labelledby="procedimentoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecione o Procedimento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="procedimentoSearch" class="form-control mb-3" placeholder="Buscar por nome ou código...">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Código</th>
                                <th>Valor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="procedimentoTableBody">
                            <!-- preenchido via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer text-end">
                <!-- Aqui o JS vai adicionar os botões de paginação -->
            </div>
        </div>
    </div>
</div>



<!-- Scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const especialidadeSelect = document.getElementById('especialidade');
    const profissionalSelect = document.getElementById('profissional');
    const calendario = document.getElementById('calendario');
    const dataSelecionadaSpan = document.getElementById('dataSelecionada');
    const tabelaHorarios = document.getElementById('tabelaHorarios');
    const btnSalvar = document.getElementById('btnSalvar');

    // Carregar profissionais ao mudar especialidade
    especialidadeSelect.addEventListener('change', () => {
        profissionalSelect.innerHTML = '<option>Carregando...</option>';
        profissionalSelect.disabled = true;
        fetch(`/marcacao/profissionais/${especialidadeSelect.value}`)
            .then(res => res.json())
            .then(data => {
                profissionalSelect.innerHTML = '<option disabled selected>Selecione</option>';
                data.profissionais.forEach(p => {
                    profissionalSelect.innerHTML += `<option value="${p.id}">${p.name}</option>`;
                });
                profissionalSelect.disabled = false;
            });
    });

    // Selecionar data e carregar horários
    profissionalSelect.addEventListener('change', () => {
        flatpickr(calendario, {
            inline: true,
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function(selectedDates, dateStr) {
                const espId = especialidadeSelect.value;
                const profId = profissionalSelect.value;
                fetch(`/marcacao/disponibilidades/${profId}/${espId}/${dateStr}`)
                    .then(res => res.json())
                    .then(data => {
                        dataSelecionadaSpan.textContent = dateStr.split('-').reverse().join('/');
                        document.getElementById('inputDataSelecionada').value = dateStr;
                        document.getElementById('inputProfissional').value = profId;
                        document.getElementById('inputEspecialidade').value = espId;

                        const selectHorario = document.getElementById('selectHorario');
                        selectHorario.innerHTML = '<option disabled selected>Selecione um horário</option>';

                        const formAgendamento = document.getElementById('formAgendamento');
                        if (data.horarios.length > 0) {
                            data.horarios.forEach(h => {
                                selectHorario.innerHTML += `<option value="${h.hora}">${h.hora}</option>`;
                            });
                            selectHorario.disabled = false;
                            formAgendamento.style.display = 'block';
                        } else {
                            selectHorario.innerHTML = '<option disabled selected>Sem horários disponíveis</option>';
                            selectHorario.disabled = true;
                            formAgendamento.style.display = 'none';
                        }
                    });
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
    const convenioSelect = document.getElementById("convenio");

    // Buscar convênios ao carregar a página
    fetch('/marcacao/convenios')
        .then(res => res.json())
        .then(data => {
            convenioSelect.innerHTML = '<option disabled selected>Selecione um convênio</option>';
            data.convenios.forEach(c => {
                convenioSelect.innerHTML += `<option value="${c.id}">${c.nome}</option>`;
            });
        });
    });

    function abrirModalProcedimento(pagina = 1) {
        const convenioId = document.getElementById('convenio').value;
        if (!convenioId) {
            alert("Selecione um convênio antes de buscar procedimentos.");
            return;
        }

    fetch('/marcacao/procedimentos', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ convenio_id: convenioId, page: pagina })
    })
    .then(res => res.json())
    .then(data => {
        const tbody = document.getElementById('procedimentoTableBody');
        tbody.innerHTML = '';

        if (!data.data || data.data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5">Nenhum procedimento encontrado.</td></tr>';
        } else {
            data.data.forEach(proc => {
                tbody.innerHTML += `
                    <tr>
                        <td>${proc.id}</td>
                        <td>${proc.procedimento}</td>
                        <td>${proc.codigo}</td>
                        <td>R$ ${proc.valor_proc}</td>
                        <td><button class="btn btn-success btn-sm"
                            onclick="selectProcedimento('${proc.id}', '${proc.procedimento}', '${proc.codigo}', '${proc.valor_proc}')">Selecionar</button></td>
                    </tr>`;
            });
        }

        // Paginação
        const footer = document.querySelector('#procedimentoModal .modal-footer');
        footer.innerHTML = '';

        if (data.current_page > 1) {
            footer.innerHTML += `<button class="btn btn-outline-secondary me-2" onclick="abrirModalProcedimento(${data.current_page - 1})">Anterior</button>`;
        }

        if (data.current_page < data.last_page) {
            footer.innerHTML += `<button class="btn btn-outline-secondary" onclick="abrirModalProcedimento(${data.current_page + 1})">Próxima</button>`;
        }

        // Mostrar modal apenas uma vez
        if (!$('#procedimentoModal').hasClass('show')) {
            $('#procedimentoModal').modal('show');
        }
    });
}




    function selectProcedimento(id, nome, codigo, valor_proc) {
        document.getElementById('procedimento_id').value = id;
        document.getElementById('procedimento_nome').value = nome;
        document.getElementById('codigo').value = codigo;
        document.getElementById('valor_proc').value = valor_proc;

        $('#procedimentoModal').modal('hide');
    }

    document.getElementById('procedimentoSearch').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        document.querySelectorAll("#procedimentoTableBody tr").forEach(row => {
            const match = [...row.children].some(td => td.textContent.toLowerCase().includes(filter));
            row.style.display = match ? '' : 'none';
        });
    });
</script>
@endsection
