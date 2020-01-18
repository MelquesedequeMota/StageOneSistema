<html>
    <head>
        <title>@yield('title')</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

        <link rel="stylesheet" type="text/css" href="css/master.css">

    </head>
    <body>
        <div class="w-100 bg-secondary fixed-top">
        	<div class="w-100 d-flex flex-row justify-content-between">
        		<div class="p-3">
        			<img src="imagens/teste.png" width="60%">
	        	</div>
	        	<div class="w-75 d-flex flex-row align-content-center justify-content-end">
                    <div class="btnMenuSuperior align-self-center">
                        <i class="iconeBtbnSuperior fas fa-bell" style="color: black"></i>     
                    </div>

                    <div class="btnMenuSuperior align-self-center">
                        <i class="iconeBtbnSuperior far fa-calendar-alt" style="position: relative; color: black">
                             <div class="alertBtn"></div>
                        </i>     
                    </div>

                    <div class="btnMenuSuperior mr-3 align-self-center">
                        <i class="fas fa-2x fa-bars" style=" color: black"></i>     
                    </div>

	        	</div>
        	</div>
        </div>

        <div class="inicio-conteudo">
            @yield('content')
        </div>

        <div class="w-100 bg-secondary fixed-bottom d-flex flex-row" style="height: 10%">

    		<a id="btnHome" href="{{ route('home') }}" class="btnMenuInferior align-self-center">
                <div class="w-50 centralizar"  style="margin-top: 2rem">
                    <i class="iconeBtbnInferior fas fa-home" style="color: black"></i>     
                </div> 
            </a>

            <a id="btnProdutos" href="{{ route('produtos') }}" class="btnMenuInferior align-self-center">
                <div class="w-50 centralizar"  style="margin-top: 2rem">
                    <i class="iconeBtbnInferior fas fa-boxes" style="color: black"></i>     
                </div> 
            </a>

            <a id="btnMovimentacoes" href="{{ route('movimentacoes') }}" class="btnMenuInferior align-self-center">
                <div class="w-50 centralizar"  style="margin-top: 2rem">
                    <i class="iconeBtbnInferior fas fa-retweet" style="color: black"></i>     
                </div> 
            </a>

            <a id="btnPDV" href="#" class="btnMenuInferior align-self-center">
                <div class="w-50 centralizar" style="margin-top: 2rem">
                    <i class="iconeBtbnInferior fas fa-pager" style="color: black"></i>     
                </div> 
            </a>
        </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">

        switch (document.title){
            case 'Home':
                $('#btnHome').attr('style', 'background-color: #343a40')
                $('#btnHome i').attr('style', 'color: #6c757d')
                break
            case 'Produtos Estoque':
                $('#btnProdutos').attr('style', 'background-color: #343a40')
                $('#btnProdutos i').attr('style', 'color: #6c757d')
                break
            case 'Movimentações':
                $('#btnMovimentacoes').attr('style', 'background-color: #343a40')
                $('#btnMovimentacoes i').attr('style', 'color: #6c757d')
                break
            case 'Ponto de Venda':
                $('#btnPDV').attr('style', 'background-color: #343a40')
                $('#btnPDV i').attr('style', 'color: #6c757d')
                break
        }

    </script>

    @yield('js')
    
</html>