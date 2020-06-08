@extends('ramodnil.page')

@section('header-title')
    <h1>
        Adicional
        <small>Criar</small>
    </h1>
@stop

@section('header-breadcrumbs')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('additionals.index') }}">Adicionais</a></li>
    <li class="breadcrumb-item active">Criar</li>
@endsection

@section('content')
    @include('admin.additionals.form')
@stop
