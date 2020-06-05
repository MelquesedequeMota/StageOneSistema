<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.4.1.js"integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>PDV</title>
</head>
<body>

    <img src="{{ URL::to('/imagens') }}/63.jpg" width='200px' heigth='200px' id='imagemproduto'>
    <button type="button" data-toggle="modal" data-target="#pesquisarproduto">
        Adicionar Produto
    </button>
    <input type='button' name='fds3' onclick='cancelarPedido()' value='Cancelar Pedido'>
    <input type='button' name='fds4' onclick='finalizarPedido()' value='Finalizar Pedido'>


    <table border='1px' id='pdv'>
        <tr>
            <th>Nome do Produto</th>
            <th>Quantidade do Produto</th>
            <th>Remover Produto</th>
        </tr>
    </table>

    <div class="modal fade" id="pesquisarproduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesquisar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type='text' name='pesquisarprodutoinput' id='pesquisarprodutoinput' placeholder='Digite aqui o nome do produto'> <input type='button' name='pesquisarprodutopesquisar' id='pesquisarprodutopesquisar' onclick='pesquisarProduto()' value='Pesquisar'>
                <br>
                <table border='1px' name='pesquisarprodutotable' id='pesquisarprodutotable'>
                    
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>

<script type='text/javascript'>

var subtotal = 0;
var total = 0;
var numprodutos = [];
var contlinhas = 0;
var linhas = [];
var produtos = [];
var metpag = 0;
var confcompra = 0;
var contlinhaspesquisa = 0;

    function adicionarItem(eanproduto, quantidade){
        if(eanproduto == 'input'){
            eanproduto = document.getElementById('eanproduto').value;
        }
        quantidade = parseInt(quantidade);
        $.ajax({
        type: "GET",
        url: "/adicionaritem/",
        data: {codigo: eanproduto},
        dataType: "json",
        success: function(data) {
            console.log(data);
            if(produtos.length != 0){

                    for(var i = 0; i < produtos.length; i++){
                        if(produtos[i][6] == data.idproduto){
                            var checar = 1;
                            var indice = i;
                        }else{
                            if(checar == 0){
                                var checar = 0;
                            }
                        }
                    }
        }

        if(checar == 1){
            if(parseInt(produtos[indice][2]) + quantidade <= data.quantidade){   
                produtos[indice][2] = parseInt(produtos[indice][2]) + quantidade; 
                calcularTotalProduto(indice, produtos[indice][2]);
                document.getElementById("valortotal["+produtos[indice][6]+"]").innerHTML = 'R$'+produtos[indice][4];
                document.getElementById("imagemproduto").src = "{{ URL::to('/imagens') }}/"+data.img;
            }else{
                alert()
            }

        }else{

            produtos.push([data.ean, data.nomeproduto, quantidade, data.valvareproduto, data.valatacproduto, data.quantidadeatacproduto, data.idproduto, data.quantidade]);

            numprodutos.push(contlinhas);

            document.getElementById("imagemproduto").src = "{{ URL::to('/imagens') }}/"+data.img;

            contlinhas++;
            linhas.push(contlinhas);
            var tabela = document.getElementById('pdv');
            var numeroLinhas = tabela.rows.length;
            var linha = tabela.insertRow(numeroLinhas);
            var celula1 = linha.insertCell(0);
            var celula2 = linha.insertCell(1);   
            var celula3 = linha.insertCell(2);
            celula1.innerHTML = produtos[produtos.length - 1][1]; 
            celula2.innerHTML = "<input type='number' id='quantidadeproduto["+produtos[produtos.length - 1][6]+"]' value='"+ produtos[produtos.length - 1][2] +"' onchange='calcularTotalProduto(this, null)' min=1 max="+produtos[produtos.length - 1][7]+">";
            celula3.innerHTML = "<input type='button' value='Remover' onclick='cancelarItem(this)' id='"+contlinhas+"'>";

        }
        
    }
        });
    }


    function cancelarItem(numeroitem){

        produtos.splice(numeroitem.id-1, 1);

        numprodutos.splice(numeroitem.id-1, 1);

        var i=numeroitem.parentNode.parentNode.rowIndex;
        document.getElementById('pdv').deleteRow(i);

        contlinhas--;

    }

    function cancelarPedido(){
        document.location.reload(true);
    }

    function finalizarPedido(){
            $.ajax({
            type: "GET",
            url: "/finalizarpedido/",
            data: {produtos: produtos, metodopagamento: metpag},
            dataType: "json",
            success: function(data) {
                if(data == 1){
                    alert('Pedido finalizada com sucesso!');
                    cancelarPedido();
                }else{
                    alert('Algo deu errado, Tente Novamente!');
                }
            }
        });
    }

    
    //Tela de pesquisar Produto

    function pesquisarProduto(){
        $.ajax({
        type: "GET",
        url: "/pesquisarproduto/",
        data: {nomeproduto: document.getElementById('pesquisarprodutoinput').value},
        dataType: "json",
        success: function(data) {
            var linhas = document.getElementById('pesquisarprodutotable').rows;
            var i = 0;
            for (i= linhas.length-1; i>=0; i--){
                    document.getElementById('pesquisarprodutotable').deleteRow(i);
            }
            
            contlinhaspesquisa++;
            var tabela = document.getElementById('pesquisarprodutotable');
            var numeroLinhas = tabela.rows.length;
            var linha = tabela.insertRow(numeroLinhas);
            var celula1 = linha.insertCell(0);
            var celula2 = linha.insertCell(1);   
            var celula3 = linha.insertCell(2);
            celula1.innerHTML = "Nome do produto".bold(); 
            celula2.innerHTML = "Quantidade do produto".bold();
            celula3.innerHTML = "Adicionar na Lista".bold();
            for(var i = 0; i < data.length; i++){
                contlinhaspesquisa++;
                var numeroLinhas = tabela.rows.length;
                var linha = tabela.insertRow(numeroLinhas);
                var celula1 = linha.insertCell(0);
                var celula2 = linha.insertCell(1);   
                var celula3 = linha.insertCell(2);
                celula1.innerHTML = data[i][1]; 
                celula2.innerHTML = "<input type='number' id='quantidadeprodutopesquisa["+data[i][6]+"]' value='"+ data[i][2] +"' max="+data[i][7]+" min=1>";
                celula3.innerHTML = "<input type='button' value='Adicionar' onclick='adicionarItemPesquisa("+data[i][0]+", "+data[i][6]+")' id='"+contlinhaspesquisa+"'>";
            }

            }
        });
    }

    function adicionarItemPesquisa(produto, idproduto){
        adicionarItem(produto,document.getElementById('quantidadeprodutopesquisa['+idproduto+']').value);
    }

</script>
</body>
</html>