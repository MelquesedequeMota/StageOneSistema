
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Criar Produto</title>
</head>
<body>

@if($conf == 1)
<script type='text/javascript'> alert('Produtos retirados com sucesso!');</script>
@endif

<button onclick="adicionaLinha('retirar')">Adicionar</button>

    <form method="get" action="{{route('retirarestoque')}}" id='formretirar' name='retirarestoque'>
        <table border='1px' id='retirar'>
        <tr>
            <th>Produto do Estoque</th>
            <th>Quantidade no Estoque</th>
            <th>Quantidade Retirada</th>
            <th>Remover Linha</th>
        </tr>
        
        </table>

        <input type='submit' value='Retirar ao Estoque' name='retirarestoque'>
    </form>
</body>
</html>

<script>
    var contlinhas = 0;
    var linhas = [];
    adicionaLinha('retirar');
    function adicionaLinha(idTabela) {
        contlinhas++;
        linhas.push(contlinhas);
        var tabela = document.getElementById(idTabela);
        var numeroLinhas = tabela.rows.length;
        var linha = tabela.insertRow(numeroLinhas);
        var celula1 = linha.insertCell(0);
        var celula2 = linha.insertCell(1);   
        var celula3 = linha.insertCell(2); 
        var celula4 = linha.insertCell(3); 
        celula1.innerHTML = "<select name='produtos[]' id='"+contlinhas+"' onchange='rodar(this)'><option value=''>Selecione um Produto</option>@foreach($estoque as $estoque)@if($estoque->quantidade > 0)<option value='{{$estoque->idproduto}}'>{{$estoque->nomeproduto}} {{$estoque->nomecor}} ({{$estoque->nometamanho}})</option>@endif @endforeach</select>"; 
        celula2.innerHTML =  "<div id='quantidade"+contlinhas+"'></div>"; 
        celula3.innerHTML =  "<div id='qtdretirar"+contlinhas+"'></div>";
        celula4.innerHTML =  "<button onclick='removeLinha(this)' id='"+contlinhas+"'>Remover</button>";
        
    }
    
    // funcao remove uma linha da tabela
    function removeLinha(linha) {
        var i=linha.parentNode.parentNode.rowIndex;
        document.getElementById('retirar').deleteRow(i);
        linhas.splice(linha.id -1, 1);
        
    }
    function rodar(esse){
        var idproduto = document.getElementById(esse.id).value;

        @foreach($estoque2 as $estoque2)

         if({{$estoque2->idproduto}} == idproduto){
            var quantidade = {{$estoque2->quantidade}};
         }

        @endforeach

        document.getElementById('quantidade'+esse.id).innerHTML = "<p align='center'> "+ quantidade +" </p>";
        document.getElementById('qtdretirar'+esse.id).innerHTML = "<input type='number'name='quantidade[]' min='1' max='"+quantidade+"' value='1'>";
    }

</script>