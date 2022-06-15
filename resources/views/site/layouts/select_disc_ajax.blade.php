<option value="" selected>Selecione a Disciplina</option>
@foreach ($lista_disc as $key => $select_disc)
    <option value="{{ $select_disc->nome }}">{{ $select_disc->codigodisciplina }} - {{ $select_disc->nome }}</option>
@endforeach
