@extends('ControleDeEstoque\master')

@section('title', 'Movimentações')

@section('content')

<div class="lista-conteudo">
	<div class="d-flex flex-row justify-content-between align-content-center">
		<div class="titulo">Movimentações</div>
		<div class="barraPesquisa">
			<input type="text" class="form-control tamanhoBarra" placeholder="`Procurar Movimentações" aria-label="`Procurar Movimentações">
			<div class="input-group-append lupaPesquisa">
				<i class="fas fa-lg fa-search"></i>
			</div>
		</div>
	</div>
	<div class="itemMovimentacao">
		<div class="w-100 p-4">
			<p class="nomeMovimentacao">Recebido “10” de “10” do produto “Feijão Verde”</p>
			<div class="infoMovimentacao d-flex flex-row justify-content-between">
				<p>Unidade: Centro <i class="fas fa-long-arrow-alt-right"></i> Aldeota</p>
				<p>Lote: 4</p>
			</div>
			<span class="dataMovimentacao p-2">10/10/2020 às 22h:00</span>
		</div>
	</div>
</div>

@endsection