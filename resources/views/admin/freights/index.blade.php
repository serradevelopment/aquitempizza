@extends('ramodnil.page')

@section('header-title')
@stop

@section('content')
<div class="my-2">
    @can('create', \App\User::class)
    <a href="{{ route('freights.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Frete</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="freights-list">
                <thead>
                    <tr>
                        <th>Bairro</th>
                        <th>Preço</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($freights as $u)
                    @php
                    $class = '';

                    if ($u->locked) {
                    $class = 'text-muted';
                }
                @endphp

                <tr class="{{ $class }}">
                    <td>{{ $u->neighborhood }}</td>
                    <td>R$ {{ number_format($u->value,2) }}</td>
                    <td>
                        <div class="table-actions">
                            @can('edit', $u)
                            <a href="{{ route('freights.edit', ['freight' => $u]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                            @endcan

                            @can('destroy', $u)
                            <form action="{{ route('freights.destroy',['freight'=>$u]) }}" method="post">
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
    $('#freights-list').DataTable();
</script>
@stop
