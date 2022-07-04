<option value="">Selecione o Curso</option>
@foreach ($lista_cursos as $key => $select_curso)

    <option selected value="{{ $select_curso->codigo_curso_sigaa }}">{{$select_curso->codigo_curso_sigaa}} - {{ $select_curso->nome }}</option>
    
@endforeach
