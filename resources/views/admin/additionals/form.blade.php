{{ Form::restForm($additional, ['id' => 'additional-form']) }}

<div class="card">
    <div class="card-body">
        {{ Form::bsText('name', 'Nome do adicional',['required'=>'true']) }}

        {{ Form::bsText('price', 'Preço',['class'=>'money-mask']) }}

    </div>
</div>
{{ Form::bsSubmit('Salvar') }}

{{ Form::close() }}

@section('js')
@endsection
