@extends('ramodnil.page')

@section('header-title')
    <h1>
        Adicional
        <small>Editar</small>
    </h1>
@stop

@section('header-breadcrumbs')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('additionals.index') }}">Adicionais</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
    @include('admin.additionals.form')
@stop
