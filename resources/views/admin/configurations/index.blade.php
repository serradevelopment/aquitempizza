@extends('ramodnil.page')

@section('header-title')
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h2>Altere as opções de configuração do site</h2>
    </div>
    <div class="card-body">
        <form method="post" action="{{route('configurations.update',['configuration'=>$configuration->id])}}">
            @csrf
            @method('put')
                <div class="form-group">
                    <label for="is_online">Atendimento Funcionando: </label >
                    <input value="1" type="checkbox" id="is_online" name="is_online" {!!($configuration->is_online)?'checked':''!!} data-toggle="toggle">
                </div>
                <div class="form-group">
                    <label for="is_freight_unique">Frete único: </label >
                    <input value="1" type="checkbox"  id="is_freight_unique" name="is_freight_unique" {!!($configuration->is_freight_unique)?'checked':''!!} data-toggle="toggle">
                    <label for="freight_value">Valor do frete único</label>
                    <input  type="text" name="freight_value" id="freight_value"  class="money-mask" value="{!! ($configuration->freight_value*100) !!}">
                </div>
                <div class="form-group">
                    <label >Texto do site: </label >
                    <textarea id="editor" class="editor" name="billboard_text">{!! $configuration->billboard_text !!}</textarea>
                </div>
            <button class="btn btn-success">Salvar</button>
        </form>
    </div>
</div>
</div>
@stop

@section('js')
    <!-- include summernote css/js -->
    <script>
        $(document).ready(function() {
        });

    </script>
@stop
