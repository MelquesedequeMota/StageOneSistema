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
    <h2>7893000394209 - 7896051130765</h2>
    <h3>
        F2 => Pagamento em Dinheiro<br>
        F4 => Cartão de Débito<br>
        F7 => Cartão de Crédito -> Á vista<br>
        F8 => Cartão de Crédito -> Parcelado<br>
        F9 => Finalizar Compra<br>
    </h3>

    <h2 id='metodopagamento'></h2>

    <img src="{{ URL::to('/imagens') }}/63.jpg" width='200px' heigth='200px' id='imagemproduto'>

    <input type='text' name='eanproduto' id='eanproduto'>

    <input type='button' name='fds' onclick='adicionarItem("input", 1)' value='Adicionar Item'>
    <button type="button" data-toggle="modal" data-target="#pesquisarproduto">
        Pesquisar
    </button>
    <input type='button' name='fds3' onclick='cancelarCompra()' value='Cancelar Compra'>
    <input type='button' name='fds4' onclick='fecharCaixa()' value='Fechar Caixa'>


    <table border='1px' id='pdv'>
        <tr>
            <th>EAN do Produto</th>
            <th>Nome do Produto</th>
            <th>Quantidade do Produto</th>
            <th>Preço Unidade</th>
            <th>Valor Total</th>
            <th>Remover Produto</th>
        </tr>
    </table>

    Subtotal: <div id='subtotal' style='background-color:#33ffff;  heigth:100px; width:100px;'></div>
    Total: <div id='total' style='background-color:#ff0000;  heigth:100px; width:100px;'>R$0</div>
    Recebido: <div id='recebido'>R$ 0,00 </div>
    Troco: <div id='troco'> R$ 0,00 </div>

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

    <input type='number' id='confirmardinheiro' style='display:none;'>

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
atualizarSubtotal();

    $(document).keydown(function (e) {
            if(e.key == "F2"){
                metpag = 0;
                confirmarDinheiro();
                document.getElementById('metodopagamento').innerHTML = "Pagamento em Dinheiro Físico";
            }

            if(e.key == "F4"){
                calcularTotal();
                document.getElementById('metodopagamento').innerHTML = "Pagamento no Cartão de Débito";
                metpag = 2;
            }

            if(e.key == "F7"){
                calcularTotal();
                document.getElementById('metodopagamento').innerHTML = "Pagamento no Cartão de Crédito Á Vista";
                metpag = 3;
            }

            if(e.key == "F8"){
                calcularTotal();
                document.getElementById('metodopagamento').innerHTML = "Pagamento no Cartão de Crédito Parcelado";
                metpag = 4;
            }

            
            if(e.key == "F9"){
                if(metpag != 0){
                    finalizarCompra();
                }else{
                    alert('Selecione uma forma de pagamento!');
                }
            }

        });

    $("#eanproduto").keypress(function(e) {
        if (e.which == 13) {
            adicionarItem('input', 1);
        }
    });

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
                atualizarSubtotal();
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
            var celula4 = linha.insertCell(3);
            var celula5 = linha.insertCell(4);
            var celula6 = linha.insertCell(5); 
            celula1.innerHTML = produtos[produtos.length - 1][0]; 
            celula2.innerHTML = produtos[produtos.length - 1][1]; 
            celula3.innerHTML = "<input type='number' id='quantidadeproduto["+produtos[produtos.length - 1][6]+"]' value='"+ produtos[produtos.length - 1][2] +"' onchange='calcularTotalProduto(this, null)' min=1 max="+produtos[produtos.length - 1][7]+">";
            celula4.innerHTML = "R$"+produtos[produtos.length - 1][3];
            celula5.innerHTML = "<div id = 'valortotal["+produtos[produtos.length - 1][6]+"]'>R$"+produtos[produtos.length - 1][4]+"</div>";
            celula6.innerHTML = "<input type='button' value='Remover' onclick='cancelarItem(this)' id='"+contlinhas+"'>";
            atualizarSubtotal();

        }

        document.getElementById('eanproduto').value = '';
        
    }
        });
    }

    function atualizarSubtotal(){

            subtotal = 0;

            for(var i = 0; i< produtos.length; i++){
                calcularSubtotal(i);
            }

            document.getElementById('subtotal').innerHTML= 'R$' + subtotal;

        
    }

    

    function calcularSubtotal(numproduto){
        
        subtotal = subtotal + produtos[numproduto][4];

    }

    function cancelarItem(numeroitem){

        produtos.splice(numeroitem.id-1, 1);

        numprodutos.splice(numeroitem.id-1, 1);

        var i=numeroitem.parentNode.parentNode.rowIndex;
        document.getElementById('pdv').deleteRow(i);

        contlinhas--;

        atualizarSubtotal();

    }

    function cancelarCompra(){
        document.location.reload(true);
    }

    function confirmarDinheiro(){
        
        document.getElementById('confirmardinheiro').style.display = 'inline';

        calcularTotal();

        $('#confirmardinheiro').keypress(function(e){

            if(e.which == 13){
                var troco = document.getElementById('confirmardinheiro').value - total;
                if(troco >= 0){
                    document.getElementById('recebido').innerHTML = 'R$' + document.getElementById('confirmardinheiro').value;
                    document.getElementById('troco').innerHTML = 'R$' + troco;
                    metpag = 1;
                }else{
                    alert('Erro: faltam R$' + troco * -1 + " para a compra ser efetuada com sucesso.");
                }
            }

        });

    }

    function imprimir(){
        alert(produtos.toString());
        alert(numprodutos.toString());
    }
    function finalizarCompra(){
            $.ajax({
            type: "GET",
            url: "/finalizarcompra/",
            data: {produtos: produtos, metodopagamento: metpag},
            dataType: "json",
            success: function(data) {
                if(data == 1){
                    alert('Compra finalizada com sucesso!');
                    cancelarCompra();
                }else{
                    alert('Algo deu errado, Tente Novamente!');
                }
            }
        });
    }

    function calcularTotal(){
        total = 0;
        
        for(var i = 0; i< produtos.length; i++){
            if(produtos[i][2] >= produtos[i][5]){
                total = total + (produtos[i][2] * produtos[i][4]);
            }else{
                total = total + (produtos[i][2] * produtos[i][3]);
            }
        }

        document.getElementById('total').innerHTML= 'R$' + total;

    }

    function calcularTotalProduto(indice,quantidade){
        var att ='';
        if(quantidade == null){
            var idproduto = indice.id.replace(/\D/g, '');
            var quantidadeproduto = indice.value;
            for(var cont = 0; cont < produtos.length; cont++){
                if(produtos[cont][6] == idproduto){
                    att = cont;
                }
            }
            produtos[att][2] = quantidadeproduto;
        }else{
            var idproduto = produtos[indice][6];
            var quantidadeproduto = quantidade;
            for(var cont = 0; cont < produtos.length; cont++){
                if(produtos[cont][6] == idproduto){
                    att = cont;
                }
            }
        }
        
        produtos[att][4] = produtos[att][3] * quantidadeproduto;
        document.getElementById("valortotal["+idproduto+"]").innerHTML = 'R$ ' + produtos[att][4];
        document.getElementById("quantidadeproduto["+idproduto+"]").value = produtos[att][2];
        atualizarSubtotal();
    }

    function fecharCaixa(){
        window.location.href='fecharcaixa';
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
            var celula4 = linha.insertCell(3);
            var celula5 = linha.insertCell(4);
            var celula6 = linha.insertCell(5);
            celula1.innerHTML = "EAN do produto".bold(); 
            celula2.innerHTML = "Nome do produto".bold(); 
            celula3.innerHTML = "Quantidade do produto".bold();
            celula4.innerHTML = "Preço Unidade".bold();
            celula5.innerHTML = "Quantidade em Estoque".bold();
            celula6.innerHTML = "Adicionar na Lista".bold();
            for(var i = 0; i < data.length; i++){
                contlinhaspesquisa++;
                var numeroLinhas = tabela.rows.length;
                var linha = tabela.insertRow(numeroLinhas);
                var celula1 = linha.insertCell(0);
                var celula2 = linha.insertCell(1);   
                var celula3 = linha.insertCell(2); 
                var celula4 = linha.insertCell(3);
                var celula5 = linha.insertCell(4);
                var celula6 = linha.insertCell(5);
                celula1.innerHTML = data[i][0]; 
                celula2.innerHTML = data[i][1]; 
                celula3.innerHTML = "<input type='number' id='quantidadeprodutopesquisa["+data[i][6]+"]' value='"+ data[i][2] +"' max="+data[i][7]+" min=1>";
                celula4.innerHTML = "R$"+data[i][3];
                celula5.innerHTML = data[i][7];
                celula6.innerHTML = "<input type='button' value='Adicionar' onclick='adicionarItemPesquisa("+data[i][0]+", "+data[i][6]+")' id='"+contlinhaspesquisa+"'>";
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