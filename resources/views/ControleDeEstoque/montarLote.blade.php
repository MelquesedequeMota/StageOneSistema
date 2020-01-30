@extends('ControleDeEstoque\master')

@section('title', 'Montar Lote')

@section('content')

<div class="lista-conteudo">
	<div class="titulo">Montar Lote - $unidade</div>
	<div class="d-flex flex-row justify-content-center align-items-center my-5">
		<button type="button" class="addProduto">Adicionar Produto</button>
		<div class="escolherUnidade">
		  <select class="custom-select" id="inputGroupSelect01" style="border: none">
		    <option selected>Escolher Unidade</option>
			<option value="#" selected="">Unidade 1</option>
			<option value="#" selected="">Unidade 2</option>
			<option value="#" selected="">Unidade 3</option>
		  </select>
		</div>
	</div>
	<div class="listaLote">
		<div class="itemLote">
			<button type="button" class="excluirProduto loteDif">X</button>
			<input type="text" name="produtoLote1" class="inputLote" placeholder="Produto">
			<div class="escolheQtdLote">
				<button type="button" id="menosQtd" class="btnQtdLote">-</button>
				<span id="valorQtd" class="valorQtdLote">10</span>
				<button type="button" id="maisQtd" class="btnQtdLote">+</button>
			</div>
		</div>
	</div>
</div>

<button class="botaoNavegacao direita"><span class="iconeNavegacao">+</span></button>

@endsection

@section('js')

@endsection