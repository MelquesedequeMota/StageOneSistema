@extends('ControleDeEstoque\master')

@section('title', 'Home')

@section('content')

<div class="comparativoVendas">
	<h4 class="suasVendas">
		Suas<br>Vendas
	</h4>
	<div class="boxVenda">
		<div class="boxContent">
			<div class="valorVenda">100</div>
			<div class="periodoVenda">Hoje</div>
		</div>
	</div>
	<div class="boxVenda">
		<div class="boxContent">
			<div class="valorVenda">300</div>
			<div class="periodoVenda">Ontem</div>
		</div>
	</div><div class="boxVenda">
		<div class="boxContent">
			<div class="valorVenda">900</div>
			<div class="periodoVenda">Esse Mês</div>
		</div>
	</div><div class="boxVenda">
		<div class="boxContent">
			<div class="valorVenda">1500</div>
			<div class="periodoVenda">Esse Ano</div>
		</div>
	</div>

	
</div>

<div class="graficoVendas">
	
</div>

<div class="produtosEstoque">
	
</div>


@endsection