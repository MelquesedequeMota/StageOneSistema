<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Pedidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type='text/javascript'>
    function habilitar(){
        if(document.getElementById('finalizados').checked == false){
            var buttons = document.getElementsByTagName('h1');
            for(var i = 0; i<buttons.length; i++){
                if(buttons[i].getAttribute('statuspedido') == '1'){
                    document.getElementById(buttons[i].getAttribute('data-target').substring(1, buttons[i].getAttribute('data-target').length)).setAttribute('class','collapse');
                    buttons[i].setAttribute('aria-expanded','false');
                    buttons[i].style.visibility = 'hidden';
                }
            }
        }else{
            var buttons = document.getElementsByTagName('h1');
            for(var i = 0; i<buttons.length; i++){
                    buttons[i].style.visibility = 'visible';
            }
        }
    }

    function attproduto(produto){
            $.ajax({
            type: "GET",
            url: "/attstatusproduto/",
            data: {iddescpedido: produto.id.split('-')[1]},
            dataType: "json",
            success: function(data) {
                checkpedido(data)
            }
        });
    }
    function checkpedido(num){
        var div = document.getElementById('pedido'+num);
        var inputs = div.getElementsByTagName('input');
        var check = 0;
        for(var u = 0; u < inputs.length; u++){
            var atual = document.getElementById(inputs[u].id);
            if(atual.checked == true){
                check++;
            }
        }
        if(check == inputs.length){
            document.getElementById('botaopedido'+num).disabled = false;
        }else{
            document.getElementById('botaopedido'+num).disabled = true;
        }
    }
    function attpedido(idpedido){
        $.ajax({
                type: "GET",
                url: "/attstatuspedido/",
                data: {idpedido : idpedido},
                dataType: "json",
                success: function(data) {
                    if(data == '1'){
                        document.getElementById('abrirpedido'+idpedido).setAttribute('aria-expanded','false');
                        document.getElementById('abrirpedido'+idpedido).setAttribute('statuspedido',1);
                        document.getElementById('abrirpedido'+idpedido).style.visibility = 'hidden';
                        document.getElementById('pedido'+idpedido).setAttribute('class','collapse');
                        habilitar();
                        desativar();
                    }
                }
            });
    }
    function desativar(){
        var butoes = document.getElementsByTagName('h1');
        var indice = 0;
        for(indice = 0; indice < butoes.length; indice++){
            if(butoes[indice].getAttribute('statuspedido') == 1){
                var idatual = butoes[indice].id.substring(11, butoes[indice].getAttribute('id').length);
                document.getElementById('botaopedido'+idatual).setAttribute('disabled', true);
                var divatual = document.getElementById('pedido'+idatual);
                var indice2 = 0;
                for(indice2 = 0; indice2 < divatual.getElementsByTagName('input').length; indice2++){
                    divatual.getElementsByTagName('input')[indice2].setAttribute('disabled',true);
                }
                
            }
        }
    }
</script>
</head>
<body>
<div id='geral'>
Habilitar Pedidos Finalizados: <input type='checkbox' id='finalizados' onchange="habilitar()">
</div>
</body>
<script type='text/javascript'>
    var dp = document.getElementById('geral');
</script>
@foreach($pedidos as $pedidos)
    <script type='text/javascript'>
        var novopedido = document.createElement('h1');
        novopedido.setAttribute('id', 'abrirpedido{{$pedidos->idpedido}}');
        novopedido.setAttribute('data-toggle', 'collapse');
        novopedido.setAttribute('data-target', '#pedido{{$pedidos->idpedido}}');
        novopedido.setAttribute('statuspedido', '{{$pedidos->statuspedido}}');
        novopedido.setAttribute('aria-expanded', 'false');
        document.body.appendChild(novopedido);
        var sla = document.createTextNode("{{$pedidos->nomepedido}} -- {{$pedidos->datapedido}}");
        novopedido.appendChild(sla);
    </script>

    <script type='text/javascript'>
    var novadiv = document.createElement('div');
        novadiv.setAttribute('id', 'pedido{{$pedidos->idpedido}}');
        novadiv.setAttribute('class', 'collapse');
        document.body.appendChild(novadiv);
        novadiv.innerHTML = "<button id='botaopedido{{$pedidos->idpedido}}' onclick='attpedido({{$pedidos->idpedido}})' disabled='true' >Finalizar Pedido</button><br>";
    </script>
    
@endforeach

@foreach($descpedidos as $descpedidos)
        @if($descpedidos->statusproduto == 0)
            <script type='text/javascript'>
                document.getElementById('pedido{{$descpedidos->idpedido}}').innerHTML += "<input type='checkbox' id='{{$descpedidos->idpedido}}-{{$descpedidos->iddescpedido}}' idpedido='{{$descpedidos->idpedido}}' onclick='attproduto(this)'>{{$descpedidos->nomeproduto}} -- {{$descpedidos->quantidadeproduto}}<br>";
            </script>
        @else
            <script type='text/javascript'>
                document.getElementById('pedido{{$descpedidos->idpedido}}').innerHTML += "<input type='checkbox' id='{{$descpedidos->idpedido}}-{{$descpedidos->iddescpedido}}' idpedido='{{$descpedidos->idpedido}}' checked onclick='attproduto(this)'>{{$descpedidos->nomeproduto}} -- {{$descpedidos->quantidadeproduto}}<br>";
            </script>
        @endif
        <script type='text/javascript'>
            checkpedido({{$descpedidos->idpedido}});
        </script>
@endforeach
<script type='text/javascript'>
    habilitar();
    desativar();
</script>
</html>
