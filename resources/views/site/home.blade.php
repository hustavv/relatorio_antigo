@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')



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
                            <img src="{{ asset('images/icons_perfil/A.png') }}" class="btn-nav btn-perfil" href="#"
                                title="Perfil" role="button" id="dropdown" aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <a href="sair" style="text-decoration: none;">
                                <li><button class="dropdown-item" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                            <path fill-rule="evenodd"
                                                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                        </svg>
                                        Sair
                                    </button></li>
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
        <legend class="fs-1 fw-semibold">Relatório de acompanhamento</legend>
        <div class="row">
            <div class="d-flex align-items-start justify-content-between">

            {{-- <div class="col-11  "> --}}

                {{-- BOTÃO PARA CHAMAR MODAL DE IMPORT --}}

                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalImport">Carregar
                    arquivo
                </button>

                {{-- FIM DO BOTÃO PARA CHAMAR MODAL DE IMPORT --}}

            {{-- </div> --}}
            {{-- <div class="col-1"> --}}

                {{-- JANELA DE FILTRAGEM --}}

                <div class="btn-group dropstart ">
                    <button type="button" class="btn btn-primary dropdown-toggle mb-3" data-bs-toggle="dropdown"
                        aria-expanded="false" style="">
                        Filtros
                    </button>
                    <ul class="dropdown-menu dropstart shadow" style="width: 60rem">
                        <form action="{{ route('site.filtro') }}" method="post">
                            @csrf
                            <li>
                                <div class="row p-2">
                                    <div class="col-4">
                                        <select class="form-select" aria-label="Default select example"
                                            name="select_curso">
                                            <option value="" selected>Selecione o curso Curso</option>
                                            <option value="Administração">Administração</option>
                                            <option value="Engenharia">Engenharia</option>
                                            <option value="Matemática">Matemática</option>
                                        </select>
                                    </div>
                                    <div class="col-4">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="media" value="1" id="media1">
                                            <label class="form-check-label" for="media1">
                                                Acima da média
                                            </label>
                                        </div>
                                    </div>


                                </div>
                            </li>
                            <li>
                                <div class="row p-2">
                                    <div class="col-4">
                                        <select class="form-select" aria-label="Default select example"
                                            name="select_disc">
                                            <option value="" selected>Selecione a Disciplina</option>
                                            <option value="Ética">Ética</option>
                                            <option value="Cáculo I">Cálculo I</option>
                                            <option value="Física I">Física I</option>
                                        </select>
                                    </div>
                                    <div class="col-4">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="media" value="2" id="media2">
                                            <label class="form-check-label" for="media2">
                                                Abaixo da média
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row p-2">
                                    <div class="col-4">
                                        <select class="form-select" aria-label="Default select example"
                                            name="select_polo">
                                            <option value="" selected>Selecione o Polo</option>
                                            <option value="aracaju">Aracaju</option>
                                            <option value="são cristovão">São Cristovão</option>
                                            <option value="lagarto">Lagarto</option>
                                        </select>
                                    </div>
                                    <div class="col-4">


                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="media" value="3" id="media3">
                                            <label class="form-check-label" for="media3">
                                                Nota sem aproveitamento
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <hr>
                                <div class="row p-2 ">
                                    <div class="col-11">

                                    </div>
                                    <div class="col-1">
                                        <button type="submit" class="btn btn-success p-2 ">Filtrar</button>
                                    </div>
                                </div>
                            </li>
                        </form>
                    </ul>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr>
                                <td>{{ $value->nome_aluno }}</td>
                                <td>{{ $value->cpf_aluno }}</td>
                                <td>{{ $value->matricula_aluno }}</td>
                                <td>{{ $value->codigo_curso }}</td>
                                <td>{{ $value->codigo_disciplina }}</td>
                                <td>{{ $value->polo }}</td>
                                <td>

                                    <div class="btn-table btn badge btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#ModalDetalhes{{ $value->id_relatorio }}">Detalhes</button>

                                </td>
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
                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Importar</button>
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
                                            <input type="text" class="form-control" placeholder="{{ $value->polo }}"
                                                readonly>
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
                                    </div>
                                </div>

                                <div class="notas">
                                    <div class="row">
                                        <div class="col-sm">
                                            <h6>AD1: </h6>
                                            <input type="text" class="form-control" placeholder="{{ $value->ad1 }}"
                                                readonly>
                                        </div>
                                        <div class="col-sm">
                                            <h6>AP1: </h6>
                                            <input type="text" class="form-control" placeholder="{{ $value->ap1 }}"
                                                readonly>
                                        </div>
                                        <div class="col-sm">
                                            <h6>AD2: </h6>
                                            <input type="text" class="form-control" placeholder="{{ $value->ad2 }}"
                                                readonly>
                                        </div>
                                        <div class="col-sm">
                                            <h6>AP2: </h6>
                                            <input type="text" class="form-control" placeholder="{{ $value->ap2 }}"
                                                readonly>
                                        </div>
                                        <div class="col-sm">
                                            <h6>AP3: </h6>
                                            <input type="text" class="form-control" placeholder="{{ $value->ap3 }}"
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
    {{-- <script>
        $('.dropdown-menu').on("click.bs.dropdown", function(e) {
            e.stopPropagation();
            e.preventDefault();
        });
    </script> --}}


@endsection
