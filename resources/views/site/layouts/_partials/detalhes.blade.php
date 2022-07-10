@php
$dadosaluno = $importacaoaluno->where('username', $value->cpf_aluno)->first();

@endphp
@foreach ($dadosaluno as $key => $valor)
<div class="col-md">
    <h6>Email: </h6>
    <input type="text" class="form-control"
       placeholder= "{{$valor['email']}}" readonly>
</div>
@endforeach
