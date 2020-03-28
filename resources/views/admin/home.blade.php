@extends('ramodnil.page')

@section('css')
{{-- Seus estilos específicos de página aqui --}}
@endsection

@section('header-title')
<h1>Início</h1>
@stop




@section('content')

<!-- Modal CADASTRAR PRODUTO -->
<div class="modal fade" id="create-product" tabindex="-1" role="dialog" aria-labelledby="create-product" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="{{route('products.store')}}" method="POST"  enctype="multipart/form-data">

			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="create-product">Cadastrar Produto no Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					{{ Form::bsText('name', 'Nome') }}
					{{ Form::bsText('description', 'Descrição') }}
					{{ Form::bsText('value', 'Preço',['class'=>'money-mask']) }}
					{{ Form::bsFile('image', 'Foto') }}
					{{ Form::bsSelect('category', 'Categoria', App\Product::categories(),['placeholder' => 'Selecione uma opção']) }}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Salvar</button>
				</div>
			</div>
		</form>

	</div>
</div>

<!-- Modal EDITAR PRODUTO-->
<div class="modal fade" id="edit-product" tabindex="-1" role="dialog" aria-labelledby="edit-product" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="{{route('products.store')}}" method="POST"  enctype="multipart/form-data">

			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="edit-product">Editar Produto no Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="id-product-edit">
					{{ Form::bsText('name', 'Nome',['id'=>'name-product-edit']) }}
					{{ Form::bsText('description', 'Descrição',['id'=>'description-product-edit']) }}
					{{ Form::bsText('value', 'Preço',['class'=>'money-mask','id'=>'value-product-edit']) }}
					<img id="img-product-edit" style="height: 120px; width: auto">
					{{ Form::bsFile('image', 'Foto') }}
					{{ Form::bsSelect('category', 'Categoria', App\Product::categories(),['placeholder' => 'Selecione uma opção','id'=>'category-product-edit']) }}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Salvar</button>
				</div>
			</div>
		</form>

	</div>
</div>

<div class="row">

	<div class="col-sm-6 col-md-3">
		<div class="card card-stats card-danger card-round">
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
							<i class="fa fa-users"></i>
						</div>
					</div>
					<div class="col col-stats">
						<div class="numbers">
							<p class="card-category">Usuários</p>
							<h4 class="card-title">{{count(App\User::all())}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<h1>Produtos</h1>
<div class="my-2">
	@can('create', \App\User::class)
	<button data-toggle="modal" data-target="#create-product" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Produto</button>
	@endcan
</div>
<div class="row">
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover" id="products-list">
					<thead>
						<tr>
							<th data-orderable="false"></th>
							<th>Nome</th>
							<th>Descrição</th>
							<th>Preço</th>
							<th data-orderable="false"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($products as $u)
						@php
						$class = '';

						if ($u->locked) {
						$class = 'text-muted';
					}
					@endphp

					<tr class="{{ $class }}">
						<td><img src="/files/products/{{$u->id}}.{{$u->img_extension}}" style="height: 120px; width: auto"> </td>
						<td>{{ $u->name }}</td>
						<td>{{ $u->description }}</td>
						<td>R$ {{ number_format($u->value,2) }}</td>
						<td>
							<div class="table-actions">
								@can('edit', $u)
								<a href="#" class="btn btn-default btn-sm" data-toggle="modal" onclick="setEditProductData({{json_encode($u)}})"  data-target="#edit-product" ><i class="fa fa-pencil-alt"></i> Editar</a>
								@endcan

								@if (!$u->locked)
								@can('block', $u)
								<a href="{{ route('products.block', ['product' => $u]) }}" class="btn btn-default btn-sm confirmable"><i class="fa fa-lock"></i> Bloquear</a>
								@endcan
								@else
								@can('unblock', $u)
								<a href="{{ route('products.unblock', ['product' => $u]) }}" class="btn btn-default btn-sm confirmable"><i class="fa fa-lock-open"></i> Desbloquear</a>
								@endcan
								@endif

								@can('destroy', $u)
								<form id="form-delete-product-{{$u->id}}" action="{{ route('products.destroy', ['product' => $u]) }}" method="POST">
									<input type="hidden" name="_method" value="DELETE">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<a href="#" onClick="document.getElementById('form-delete-product-{{$u->id}}').submit();" class="btn btn-default btn-sm"><i class="fa fa-trash-alt"></i> Excluir</a>
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
</div>
@stop

@section('js')
<script type="text/javascript">
	$('#products-list').DataTable();	

	function setEditProductData(product)
	{
		console.log(product);
		$('#name-product-edit').val(product.name);
		$('#description-product-edit').val(product.description);
		$('#value-product-edit').val(product.value);
		$('#id-product-edit').val(product.id);
		$('#img-product-edit').attr('src','files/products/'+product.id+'.'+product.img_extension);

		///
	}
</script>
@endsection