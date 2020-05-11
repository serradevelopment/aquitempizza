@extends('ramodnil.page')

@section('css')
{{-- Seus estilos específicos de página aqui --}}
@endsection





@section('content')

<!-- Modal CADASTRAR PRODUTO -->
<div class="modal fade" id="create-product" tabindex="-1" role="dialog" aria-labelledby="create-product"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">

			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="create-product">Cadastrar Produto no Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					{{ Form::bsText('name', 'Nome',['required'=>true]) }}
					{{ Form::bsText('description', 'Descrição') }}
					{{ Form::bsText('value', 'Preço',['class'=>'money-mask','required'=>true]) }}
					{{ Form::bsFile('image', 'Foto',['required'=>true]) }}
					<small>Formatos de imagem suportados: jpeg|png|jpg|gif|svg</small>
					{{ Form::bsSelect('category', 'Categoria', App\Product::categories(),['placeholder' => 'Selecione uma opção','class'=>'select-2','required'=>true]) }}

					{{ Form::bsSelect('tag', 'Adicione uma etiqueta', ['PROMOÇÃO'=>'PROMOÇÃO','ESPECIAL'=>'ESPECIAL','FRETE GRÁTIS'=>'FRETE GRÁTIS'],['placeholder' => 'Selecione uma opção','id'=>'is_top-product-create','class'=>'select-2']) }}

					{{ Form::bsSelect('is_top', 'Mais vendido?', ['NÃO','SIM'],['placeholder' => 'Selecione uma opção','id'=>'is_top-product-create','required'=>true]) }}

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
		<form action="" method="POST" id="form-edit-product" enctype="multipart/form-data">

			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="edit-product">Editar Produto no Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="id-product-edit">
					{{ Form::bsText('name', 'Nome',['id'=>'name-product-edit','required'=>true]) }}
					{{ Form::bsText('description', 'Descrição',['id'=>'description-product-edit']) }}
					{{ Form::bsText('value', 'Preço',['class'=>'money-mask','id'=>'value-product-edit','required'=>true]) }}
					<img id="img-product-edit" style="height: 120px; width: auto">
					{{ Form::bsFile('image', 'Foto') }}
					<small>Formatos de imagem suportados: jpeg|png|jpg|gif|svg</small>

					{{ Form::bsSelect('category', 'Categoria', App\Product::categories(),['placeholder' => 'Selecione uma opção','id'=>'category-product-edit','class'=>'select-2','required'=>true]) }}

					{{ Form::bsSelect('tag', 'Adicione uma etiqueta', ['PROMOÇÃO'=>'PROMOÇÃO','ESPECIAL'=>'ESPECIAL','FRETE GRÁTIS'=>'FRETE GRÁTIS'],['placeholder' => 'Selecione uma opção','id'=>'is_top-product-edit','class'=>'select-2']) }}

					{{ Form::bsSelect('is_top', 'Mais vendido?', ['NÃO','SIM'],['placeholder' => 'Selecione uma opção','id'=>'is_top-product-edit','required'=>true]) }}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Salvar</button>
				</div>
			</div>
		</form>

	</div>
</div>

<!-- Modal VISUALIZAR DETALHES DO PEDIDO-->
<div class="modal fade" id="show-order" tabindex="-1" role="dialog" aria-labelledby="show-order" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">PEDIDO #<span id="order-id"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<h4>Cliente</h4>
						<label><b>Nome: </b></label>
						<p id="order-client_name"></p>
						<label><b>Endereço: </b></label>
						<p id="order-client_address"></p>
						<label><b>Bairro: </b></label>
						<p id="order-neighborhood"></p>

					</div>

					<div class="col-md-6">
						<label><b>Pagamento com cartão? </b></label>
						<p id="order-is_card"></p>
						<div id="order-troco"></div>
					</div>
				</div>
				<hr />
				<h4>Produtos</h4>
				<div class="row" id="order-products">
				</div>
				<hr />
				<div class="row container">
					<h2><b>Total: </b>
						<h2 id="order-total"></h2>
					</h2>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Sair</button>
			</div>
		</div>

	</div>
</div>
<div class="row">

	<div class="col-sm-6 col-md-3">
		<div class="card card-stats card-danger card-round">
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
							<i class="fas fa-motorcycle"></i>
						</div>
					</div>
					<div class="col col-stats">
						<div class="numbers">
							<p class="card-category">PEDIDOS</p>
							<h4 class="card-title">{{count(App\Order::all())}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@php
	$total = 0;
	$media = 0;
	$orders = App\Order::OrderBy('created_at','desc')->get();
	foreach($orders as $order){
	$total+= $order->total;
	}
	$media = (count($orders) > 0)?$total / count($orders):0;
	@endphp
	<div class="col-sm-6 col-md-3">
		<div class="card card-stats card-danger card-round">
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
							<b>R</b><i class="fas fa-dollar-sign"></i>
						</div>
					</div>
					<div class="col col-stats">
						<div class="numbers">
							<p class="card-category">RECEITA</p>
							<h4 class="card-title">{{number_format($total,2)}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-3">
		<div class="card card-stats card-danger card-round">
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
							<i class="fas fa-receipt"></i>
						</div>
					</div>
					<div class="col col-stats">
						<div class="numbers">
							<p class="card-category">TICKET MÉDIO</p>
							<h4 class="card-title">R$ {{number_format($media,2)}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<h1>Pedidos</h1>
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover" id="orders-list">
				<thead>
					<tr>
						<th>Cliente</th>
						<th data-orderable="false">Endereço</th>
						<th data-orderable="false">Bairro</th>
						<th data-orderable="false">Data</th>
						<th>TOTAL</th>
						<th data-orderable="false"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $u)
					@php
					$class = '';

					if ($u->locked) {
					$class = 'text-muted';
					}
					@endphp

					<tr class="{{ $class }}">
						<td>{{ $u->client_name }}</td>
						<td>{{ $u->client_address }}</td>
						<td>{{ $u->freight->neighborhood }}</td>
						<td>{{ date('d/m/Y H:m',strtotime($u->created_at))}}</td>
						<td><span class="badge badge-success">R$ {{ number_format($u->total,2) }}</span></td>
						<td class="table-actions">
							<button data-toggle="modal" data-target="#show-order" class="btn btn-primary"
								onclick="showDetailsOrder({{ json_encode($u) }})"><i
									class="fas fa-info-circle"></i></button>
						</td>
						{{-- <td>
							<div class="table-actions">
								@can('edit', $u)
								<a href="#" class="btn btn-default btn-sm" data-toggle="modal" onclick="setEditProductData({{json_encode($u)}})"
						data-target="#edit-product" ><i class="fa fa-pencil-alt"></i> Editar</a>
						@endcan

						@if (!$u->locked)
						@can('block', $u)
						<a href="{{ route('products.block', ['product' => $u]) }}"
							class="btn btn-default btn-sm confirmable"><i class="fa fa-lock"></i> Bloquear</a>
						@endcan
						@else
						@can('unblock', $u)
						<a href="{{ route('products.unblock', ['product' => $u]) }}"
							class="btn btn-default btn-sm confirmable"><i class="fa fa-lock-open"></i> Desbloquear</a>
						@endcan
						@endif

						@can('destroy', $u)
						<form id="form-delete-product-{{$u->id}}"
							action="{{ route('products.destroy', ['product' => $u]) }}" method="POST">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<a href="#" onClick="document.getElementById('form-delete-product-{{$u->id}}').submit();"
								class="btn btn-default btn-sm"><i class="fa fa-trash-alt"></i> Excluir</a>
						</form>

						@endcan
		</div>
		</td> --}}
		</tr>
		@endforeach
		</tbody>
		</table>
	</div>
</div>
</div>

@error('image')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
<h1>Produtos</h1>
<div class="my-2">
	@can('create', \App\User::class)
	<button data-toggle="modal" data-target="#create-product" class="btn btn-primary"><i class="fa fa-plus"></i> Novo
		Produto</button>
	@endcan
</div>
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
						<td><img src="/files/products/{{$u->id}}.{{$u->img_extension}}"
								style="height: 120px; width: auto"> </td>
						<td>{{ $u->name }}</td>
						<td>{{ $u->description }}</td>
						<td>R$ {{ number_format($u->value,2) }}</td>
						<td>
							<div class="table-actions">
								@can('edit', $u)
								<a href="#" class="btn btn-default btn-sm" data-toggle="modal"
									onclick="setEditProductData({{json_encode($u)}})" data-target="#edit-product"><i
										class="fa fa-pencil-alt"></i> Editar</a>
								@endcan

								@if (!$u->locked)
								@can('block', $u)
								<a href="{{ route('products.block', ['product' => $u]) }}"
									class="btn btn-default btn-sm confirmable"><i class="fa fa-lock"></i> Bloquear</a>
								@endcan
								@else
								@can('unblock', $u)
								<a href="{{ route('products.unblock', ['product' => $u]) }}"
									class="btn btn-default btn-sm confirmable"><i class="fa fa-lock-open"></i>
									Desbloquear</a>
								@endcan
								@endif

								@can('destroy', $u)
								<form id="form-delete-product-{{$u->id}}"
									action="{{ route('products.destroy', ['product' => $u]) }}" method="POST">
									<input type="hidden" name="_method" value="DELETE">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<a href="#"
										onClick="document.getElementById('form-delete-product-{{$u->id}}').submit();"
										class="btn btn-default btn-sm"><i class="fa fa-trash-alt"></i> Excluir</a>
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
<script type="text/javascript">
	$('#products-list').DataTable();	
	$('#orders-list').DataTable();	

	function setEditProductData(product)
	{
		console.log(product);
		$('#name-product-edit').val(product.name);
		$('#description-product-edit').val(product.description);
		$('#value-product-edit').val(product.value);
		$('#id-product-edit').val(product.id);
		$('#is_top-product-edit').val(product.is_top);
		$('#tag-product-edit').val(product.tag);
		$('#img-product-edit').attr('src','files/products/'+product.id+'.'+product.img_extension);
		$('#form-edit-product').attr('action','/admin/products/'+product.id);

		///
	}

	function showDetailsOrder(order){
		$('#order-id').html(order.id);
		$('#order-client_name').html(order.client_name);
		$('#order-client_address').html(order.client_address);
		$('#order-created_at').html(order.created_at);
		$('#order-total').html('R$ '+order.total.toFixed(2));
		$('#order-is_card').html((order.is_card)?"Sim":"Não");
		if(order.troco != 0){
			$('#order-troco').html("<label><b>Troco: </b></label><p>R$ "+order.troco.toFixed(2)+"</p>");
		}
		$('#order-neighborhood').html(order.freight.neighborhood);

		html_products = "";
		for (let index = 0; index < order.products.length; index++) {
			html_products += "<div class='col-md-6'><label><b>Item "+(parseInt(index)+1)+": </b></label><p>"+order.products[index].name+" | R$ "+order.products[index].value.toFixed(2)+"</p></div>";
			
		}
		$('#order-products').html(html_products);

	}
</script>
@endsection