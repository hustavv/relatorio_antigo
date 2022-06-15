<option value="">Selecione o Curso</option>
@foreach ($lista_cursos as $key => $select_curso)
    <option selected value="{{ $select_curso->nome }}">{{ $select_curso->nome }}</option>
@endforeach
