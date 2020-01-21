@extends('master')

@section('title', 'Produtos Estoque')

@section('content')

<div class="lista-conteudo">
	<div class="d-flex flex-row justify-content-between align-content-center">
		<div class="titulo">Produtos</div>
		<div class="barraPesquisa">
			<input type="text" class="form-control tamanhoBarra" placeholder="Pesquisar produto" aria-label="Pesquisar produto">
			<div class="input-group-append lupaPesquisa">
				<i class="fas fa-lg fa-search"></i>
			</div>
		</div>
	</div>
	<div class="itemProduto">
		<img src="imagens/64.jpeg" width="25%" height="100%" style="object-fit: cover">
		<div class="d-flex flex-column w-75">
			<div class="containerInfoProduto">
				<h3 class="nomeProduto">Nome do Produtoaaaaaaaaaa</h3>
				<hr class="linhaProduto">
			</div>
			<div class="d-flex flex-row justify-content-around w-100">
				<div>
					<p class="infoProduto">
					Preço Varejo: R$ 10,00
					</p>
					<p class="infoProduto">
						Tamanho: Médio
					</p>
				</div>
				<div class="text-center">
					<h4>Em Estoque:</h4>
					<h1>700</h1>
				</div>
				<div class="text-center">
					<h4>Vendidos:</h4>
					<h1>1200</h1>
				</div>
			</div>
		</div>
		<div class="barraCorProduto"></div>
	</div>
</div>

<button class="botaoAdd"><i class="iconeAdd">+</i></button>

@endsection

@section('js')

<script type="text/javascript">
	
	$('.barraCorProduto').attr('style', 'background-color: green');

</script>

@endsection