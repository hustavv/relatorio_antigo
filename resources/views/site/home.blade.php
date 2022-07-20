@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')

    <?php
    $nome = $_SESSION['nome'];
    $letra = explode(' ', $nome);
    
    $letra[0][0];
    
    ?>


    <!--INICIO NAVBAR-->
    <nav class="navbar navbar-light d-flex shadow">
        <div class="container-fluid justify-content-end">


            <div class="offcanvas offcanvas-start" style="width: 74px;" data-bs-scroll="true" data-bs-backdrop="false"
                tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-body">
                    <!--INICIO SIDEBAR RESPONSIVO-->

                    <!--FIM SIDEBAR RESPONSIVO-->
                </div>
            </div>

            <ul class="nav d-flex">
                <li>
                    <div class="dropdown dropstart">
                        <a href="#" class="" type="button" id="dropdownMenu2" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="/relatorio/images/icons_perfil/<?php echo $letra[0][0]; ?>.png" class="btn-nav btn-perfil"
                                href="#" title="Perfil" role="button" id="dropdown" aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <a href="sair" style="text-decoration: none;">
                                <li><button class="dropdown-item" type="button" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                            <path fill-rule="evenodd"
                                                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                        </svg>
                                        Sair
                                    </button>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </a>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!--FIM NAVBAR-->


    {{-- INICIO DO CONTAINER --}}

    <div class="mt-4 container">
        <legend class="fs-1 fw-semibold">Relatório de acompanhamento de notas</legend>

        {{-- VALIDACOES --}}

        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible" id="alertaSucesso" role="alert">
                {{ session()->get('message') }}
                <span id="spanSucesso" type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">
                    </span>
                </span>
            </div>
        @endif

        @error('file')
            <div class="alert alert-danger alert-dismissible" id="alertaErro" role="alert">
                Formato de arquivo inválido
                <span id="spanErro" type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">/
                    </span>
                </span>
            </div>
        @enderror

        {{-- FIM VALIDACOES --}}

        <div class="row">
            <div class="d-flex justify-content-between">



                {{-- BOTÃO PARA CHAMAR MODAL DE IMPORT --}}

                {{-- O ID de usuario e usado ao inves do tipo, pois o orbi nao permite ao usuarios terem multiplos tipos de acesso --}}
                @if (in_array($_SESSION['idusuario'], [507, 1047]))
                    <div class="">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalImport"
                            id="carregar">Carregar
                            arquivo
                        </button>
                    </div>
                @endif

                {{-- FIM DO BOTÃO PARA CHAMAR MODAL DE IMPORT --}}



                {{-- JANELA DE FILTRAGEM --}}

                <div class="btn-group ms-auto">
                    <button type="button" class="btn btn-primary dropdown-toggle mb-3" data-bs-toggle="dropdown"
                        aria-expanded="false" style="" data-bs-display="static">
                        Filtros
                    </button>
                    {{-- <ul class="dropdown-menu dropstart shadow" style="width: 60rem"> --}}
                    <form name="selectForm" id="selectForm"
                        class="dropdown-menu dropdown-menu-end dropdown-menu-start shadow breakpoint-filter"
                        action="{{ route('site.filtro') }}" method="post" data-disc-url="{{ route('load.disc') }}"
                        data-curso-url="{{ route('load.curso') }}">
                        @csrf

                        {{-- SELECT ESCONDIDO PARA PASSAR O REQUEST --}}
                        <select hidden class="form-select form-select-sm" aria-label="Default select example"
                            id="select_semestre_request" name="select_semestre_request">

                            @foreach ($lista_semestres as $key => $select_semestre)
                                <option value="{{ $select_semestre->idsemestre }}">{{ $select_semestre->ano }}-
                                    {{ $select_semestre->semestre }}</option>
                            @endforeach

                        </select>
                        {{-- FIM DO SELECT ESCONDIDO PARA PASSAR O REQUEST --}}

                        <li>
                            <div class="row p-2">

                                <div class="col-md filter-group">
                                    <p class="text-center">Oferta</p>
                                    <select class="form-select" aria-label="Default select example" name="select_curso"
                                        id="select_curso">
                                        <option value="" selected>Selecione o Curso</option>

                                        @foreach ($lista_cursos as $key => $select_curso)
                                            <option value="{{ $select_curso->codigo_curso_sigaa }}">
                                                {{ $select_curso->codigo_curso_sigaa }} - {{ $select_curso->nome }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <select class="form-select" aria-label="Default select example" name="select_disc"
                                        id="select_disc">
                                        <option value="" selected>Selecione a Disciplina</option>
                                        @foreach ($lista_disc as $key => $select_disc)
                                            <option value="{{ $select_disc->codigodisciplina }}">
                                                {{ $select_disc->codigodisciplina }} -
                                                {{ $select_disc->nome }}</option>
                                        @endforeach

                                    </select>

                                    <select class="form-select" aria-label="Default select example" name="select_polo"
                                        id="select_polo">

                                        <option value="" selected>Selecione o Polo</option>
                                        @foreach ($lista_polos as $key => $select_polo)
                                            <option value="{{ $select_polo->nome }}">{{ $select_polo->nome }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="col-md filter-group radio-button-filter">
                                    <p class="text-center">Filtros</p>
                                    <div class="radio-button-box">
                                        <input class="radio-button-display" type="radio" name="media" value="1"
                                            id="media1">
                                        <label class="radio-button-label" title="Notas maiores ou iguais a 5"
                                            for="media1">
                                            Acima da média
                                        </label>
                                    </div>

                                    <div class="radio-button-box">
                                        <input class="radio-button-display" type="radio" name="media" value="2"
                                            id="media2" checked>
                                        <label class="radio-button-label" title="Notas abaixo de 5" for="media2">
                                            Abaixo da média
                                        </label>
                                    </div>

                                    <div class="radio-button-box">
                                        <input class="radio-button-display" type="radio" name="media" value="3"
                                            id="media3">
                                        <label class="radio-button-label" title="Notas iguais a 0" for="media3">
                                            Nota sem aproveitamento
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md filter-group checkbox-filter">
                                    <p class="text-center">Avaliações</p>
                                    <div class="checkbox-box checkbox-box-small">
                                        <input type="checkbox" name="ad1" value="1" id="ad1">
                                        <label for="ad1" id="labelAvaliacoes1">
                                            AD-1
                                        </label>
                                        <input type="checkbox" name="ap1" value="1" id="ap1">
                                        <label for="ap1" id="labelAvaliacoes2">
                                            AP-1
                                        </label>
                                    </div>
                                    {{-- <div class="checkbox-box">
                                        
                                    </div> --}}
                                    <div class="checkbox-box checkbox-box-small">
                                        <input type="checkbox" name="ad2" value="1" id="ad2">
                                        <label for="ad2" id="labelAvaliacoes3">
                                            AD-2
                                        </label>
                                        <input type="checkbox" name="ap2" value="1" id="ap2">
                                        <label for="ap2" id="labelAvaliacoes4">
                                            AP-2
                                        </label>
                                    </div>

                                    {{-- <div class="checkbox-box">
                                       
                                    </div> --}}

                                    <div class="checkbox-box checkbox-box-small">
                                        <input type="checkbox" name="ap3" value="1" id="ap3">
                                        <label for="ap3" id="labelAvaliacoes5">
                                            AP-3
                                        </label>
                                    </div>

                                </div>
                                <div class="col-md filter-group checkbox-filter">
                                    <p class="text-center">Médias</p>
                                    <div class="checkbox-box checkbox-box-large" id="checkbox-box-media">
                                        <input type="checkbox" name="n1" value="1" id="n1">
                                        <label for="n1" title="AP1 + AD1" id="labeln1">
                                            Nota 1
                                        </label>
                                    </div>
                                    <div class="checkbox-box checkbox-box-large" id="checkbox-box-media">
                                        <input type="checkbox" name="n2" value="1" id="n2">
                                        <label for="n2" title="AD2 +AP2" id="labeln2">
                                            Nota 2
                                        </label>
                                    </div>
                                    <div class="checkbox-box checkbox-box-large" id="checkbox-box-media">
                                        <input type="checkbox" name="mf" value="1" id="mf">
                                        <label for="mf" id="labelmf">
                                            Média
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <hr>
                            <div class="row p-2 ">
                                <div class="col-lg d-flex">
                                    <button type="button" class="btn btn-secondary p-2" id="limpar">Limpar
                                        campos</button>
                                </div>
                                <div class="col-lg d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success p-2">Filtrar</button>
                                </div>
                            </div>
                        </li>
                    </form>
                    {{-- </ul> --}}
                </div>
                <div class="" style="margin-left: 1%">

                    <select class="form-select" aria-label="Default select example" id="select_semestre"
                        name="select_semestre">

                        @foreach ($lista_semestres as $key => $select_semestre)
                            <option value="{{ $select_semestre->idsemestre }}">{{ $select_semestre->ano }}-
                                {{ $select_semestre->semestre }}</option>
                        @endforeach

                    </select>

                </div>

                {{-- </div> --}}
            </div>

            {{-- FIM DA JANELA DE FILTRAGEM --}}

            {{-- INICIO DA DATATABLE --}}

            <div class="mt-4 col">
                <table id="example" class="table table-striped datatables table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th class="th-nome">Nome</th>
                            <th class="th-cpf">CPF</th>
                            <th class="th-matricula">Matrícula</th>
                            <th class="th-curso">Curso</th>
                            <th class="th-disciplina">Disciplina</th>
                            <th class="th-polo">Polo</th>
                            <th class="th-acoes">Ações</th>

                            {{-- COLUNAS INVISÍVEIS PARA EXPORTAÇÃO --}}
                            <th>AD1</th>
                            <th>AP1</th>
                            <th>AD2</th>
                            <th>AP2</th>
                            <th>AP3</th>
                            {{-- FIM DAS COLUNAS INVISÍVEIS --}}

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr>
                                <td>{{ $value->nome_aluno }}</td>
                                <td>{{ $value->cpf_aluno }}</td>
                                <td>{{ $value->matricula_aluno }}</td>
                                <td>{{ $value->nome_curso }}</td>
                                <td>{{ $value->nome_disciplina }}</td>
                                <td>{{ $value->polo }}</td>
                                <td>

                                    <div class="btn-table btn badge btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#ModalDetalhes{{ $value->id_relatorio }}">Detalhes</button>

                                </td>

                                {{-- COLUNAS INVISÍVEIS PARA EXPORTAÇÃO --}}
                                <td>{{ $value->ad1 }}</td>
                                <td>{{ $value->ap1 }}</td>
                                <td>{{ $value->ad2 }}</td>
                                <td>{{ $value->ap2 }}</td>
                                <td>{{ $value->ap3 }}</td>
                                {{-- FIM DAS COLUNAS INVISÍVEIS --}}

                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>

            {{-- FIM DA DATATABLE --}}

        </div>
    </div>

    {{-- FIM DO CONTAINER --}}

    {{-- INICIO DO MODAL DE IMPORT --}}

    <div id="ModalImport" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" action="{{ route('dados.import') }}">
                    @csrf
                    <div class="modal-header">

                        <h3 class="modal-title">Carregar arquivo</h3>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>

                    </div>
                    <div class="modal-body">
                        <div class="mb-3">

                            <label for="formFileSm" class="form-label">*Somente arquivo csv</label>
                            <input name="file" class="form-control form-control-sm" id="formFileSm" type="file"
                                accept=".csv">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Importar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- FIM DO MODAL DE IMPORT --}}

    {{-- INICIO MODAL DE DETALHES --}}

    @foreach ($data as $key => $value)
        <div id="ModalDetalhes{{ $value->id_relatorio }}" class="modal fade">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <div class="modal-header">

                        <h3 class="modal-title">Detalhes sobre o aluno</h3>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            {{-- <input class="form-control" type="text" placeholder="{{$value->nome_aluno}}" readonly> --}}
                            <form>
                                <div class="dados-gerais">
                                    <div class="row">
                                        <div class="col-lg">
                                            <h6>Nome: </h6>
                                            <input type="text" class="form-control"
                                                placeholder="{{ $value->nome_aluno }}" readonly>
                                        </div>
                                        <div class="col-lg">
                                            <h6>CPF: </h6>
                                            <input type="text" class="form-control"
                                                placeholder="{{ $value->cpf_aluno }}" readonly>
                                        </div>
                                        <div class="col-lg">
                                            <h6>Matrícula: </h6>
                                            <input type="text" class="form-control"
                                                placeholder="{{ $value->matricula_aluno }}" readonly>
                                        </div>
                                        <div class="col-lg">
                                            <h6>Polo: </h6>
                                            <input type="text" class="form-control"
                                                placeholder="{{ $value->polo }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <h6>Código do Curso: </h6>
                                            <input type="text" class="form-control"
                                                placeholder="{{ $value->codigo_curso }}" readonly>
                                        </div>
                                        <div class="col-md">
                                            <h6>Código da Disciplina: </h6>
                                            <input type="text" class="form-control"
                                                placeholder="{{ $value->codigo_disciplina }}" readonly>
                                        </div>
                                        <div class="col-md">
                                            <h6>Nome do Curso: </h6>
                                            <input type="text" class="form-control"
                                                placeholder="{{ $value->nome_curso }}" readonly>
                                        </div>
                                        <div class="col-md">
                                            <h6>Nome da disciplina: </h6>
                                            <input type="text" class="form-control"
                                                placeholder="{{ $value->nome_disciplina }}" readonly>
                                        </div>
                                        
                                        {{-- @include('site.layouts._partials.detalhes') --}}
                                    </div>
                                </div>

                                <div class="notas">
                                    <div class="row">
                                        <div class="col-sm">
                                            <h6>AD1: </h6>
                                            <input type="text" class="form-control"
                                                @if ($value->ad1 == '') placeholder="Sem nota"
                                            @else placeholder={{ $value->ad1 }} @endif
                                                readonly>
                                        </div>
                                        <div class="col-sm">
                                            <h6>AP1: </h6>
                                            <input type="text" class="form-control"
                                                @if ($value->ap1 == '') placeholder="Sem nota"
                                            @else placeholder={{ $value->ap1 }} @endif
                                                readonly>
                                        </div>
                                        <div class="col-sm">
                                            <h6>AD2: </h6>
                                            <input type="text" class="form-control"
                                                @if ($value->ad2 == '') placeholder="Sem nota"
                                            @else placeholder={{ $value->ad2 }} @endif
                                                readonly>
                                        </div>
                                        <div class="col-sm">
                                            <h6>AP2: </h6>
                                            <input type="text" class="form-control"
                                                @if ($value->ap2 == '') placeholder="Sem nota"
                                            @else placeholder={{ $value->ap2 }} @endif
                                                readonly>
                                        </div>
                                        <div class="col-sm">
                                            <h6>AP3: </h6>
                                            <input type="text" class="form-control"
                                                @if ($value->ap3 == '') placeholder="Sem nota"
                                                @else placeholder={{ $value->ap3 }} @endif
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- FIM DO MODAL DE DETALHES --}}


    <script>
        $('.dropdown-menu').on("click.bs.dropdown", function(e) {
            e.stopPropagation();
        });
    </script>




@endsection
