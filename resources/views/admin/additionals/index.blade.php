@extends('ramodnil.page')

@section('header-title')
@stop

@section('content')
<div class="my-2">
    @can('create', \App\User::class)
    <a href="{{ route('additionals.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Adicional</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="additionals-list">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($additionals as $u)
                    @php
                    $class = '';

                    if ($u->locked) {
                    $class = 'text-muted';
                }
                @endphp

                <tr class="{{ $class }}">
                    <td>{{ $u->name }}</td>
                    <td>R$ {{ number_format($u->price,2) }}</td>
                    <td>
                        <div class="table-actions">
                            @can('edit', $u)
                            <a href="{{ route('additionals.edit', ['additional' => $u]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                            @endcan

                            @can('destroy', $u)
                            <form action="{{ route('additionals.destroy',['additional'=>$u]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm confirmable"><i class="fa fa-trash"></i></button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@stop

@section('js')
<script>
    $('#additionals-list').DataTable();
</script>
@stop
