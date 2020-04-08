{{ Form::restForm($freight, ['id' => 'freight-form']) }}

<div class="card">
    <div class="card-body">
        {{ Form::bsText('neighborhood', 'Nome do bairro',['required'=>'true']) }}

        {{ Form::bsText('value', 'Preço',['class'=>'money-mask']) }}

    </div>
</div>
{{ Form::bsSubmit('Salvar') }}

{{ Form::close() }}

@section('js')
@endsection
