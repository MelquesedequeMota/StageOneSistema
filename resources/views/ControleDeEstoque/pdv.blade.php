@extends('ControleDeEstoque\master')

@section('title', 'Ponto de Venda')

@section('content')

<div style="padding: 0 2rem">
	<div class="sticky-top" style="background-color: white">
		<div style="height: 8.5%"></div>
		<input type="text" name="codigoProduto" placeholder="Código do Produto" class="codigoInput">
		<div class="produtoSelecionado">
			<button type="button" class="excluirProduto">X</button>
			<img src="imagens/63.jpeg" width="30%" height="85%" class="align-self-center" style="object-fit: cover">
			<div class="infoProdutoSelect">
				<div class="w-75">
					<h1>Leite Ninho</h1>
					<h3>Código: T4LT4L</h3>
					<h3>Valor unitário: R$ <span id="valorUni">10.00</span></h3>
					<h3>Valor total: R$ <span id="valorTotal">100.00</span></h3>
				</div>
				<div class="escolheQtd">
					<button type="button" id="menosQtd" class="btnQtd">-</button>
					<span id="valorQtd" class="valorQtd">10</span>
					<button type="button" id="maisQtd" class="btnQtd">+</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="containerTabela">
		<table class="table" style="font-size: 2rem !important;">
		  <thead>
		    <tr>
		      <th scope="col">Produto</th>
		      <th scope="col">Qtd</th>
		      <th scope="col"></th>
		      <th scope="col">Valor Unitário</th>
		      <th scope="col">Valor Total</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td scope="row">Leite Ninho</td>
		      <td>21</td>
		      <td>x</td>
		      <td>R$ 12,00</td>
		      <td>R$ 312.312,00</td>
		    </tr>
		    <tr>
		      <td scope="row">Blusa Verde</td>
		      <td>12</td>
		      <td>x</td>
		      <td>R$ 2,00</td>
		      <td>R$ 24,00</td>
		    </tr>
		    <tr>
		      <td scope="row">Calça de Jeans Azul</td>
		      <td>32</td>
		      <td>x</td>
		      <td>R$ 22,00</td>
		      <td>R$ 3.224,00</td>
		    </tr>
		    <tr>
		      <td scope="row">Calça de Jeans Azul</td>
		      <td>32</td>
		      <td>x</td>
		      <td>R$ 22,00</td>
		      <td>R$ 3.224,00</td>
		    </tr>

		  </tbody>
		</table>
	</div>

	<div class="subtotal">
		<div class="d-flex flex-row">
			<span class="tituloSubtotal">Subtotal:</span>
			<span class="valorSubtotal">R$ 319,00</span>
		</div>
	</div>
	
</div>

@endsection

@section('js')

<script type="text/javascript">

	let valorUni = parseInt($('#valorUni').text())

	console.log((4).toFixed(2))
	$('#menosQtd').click( function(){

		if(parseInt($('#valorQtd').text()) > 0)
			$('#valorQtd').text(parseInt($('#valorQtd').text())-1)


		$('#valorTotal').text((valorUni * parseInt($('#valorQtd').text())).toFixed(2))
	}); 

	$('#maisQtd').click( function(){

		$('#valorQtd').text(parseInt($('#valorQtd').text())+1)


		$('#valorTotal').text((valorUni * parseInt($('#valorQtd').text())).toFixed(2))
	}); 

</script>
@endsection