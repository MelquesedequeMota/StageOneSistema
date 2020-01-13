<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qr Code</title>
</head>
<body>
@if($conf == 1)
<script type='text/javascript'> alert('Lote Gerado com Sucesso!'); </script>
@endif

@if($conf == 2)
<script type='text/javascript'>
function retornar(msg, callback){
    alert(msg);
    callback(1);
}
retornar('Erro! Houve uma tentativa de retirar uma quantidade acima da que o estoque possui!', function(num){
    if(num == 1){
        window.location.href = "http://127.0.0.1:8000/montarlote";
    }
});
</script>
@endif

<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=127.0.0.1:8000/receberlote/{{$loteatual}}'><br>
Número do Lote: {{$loteatual}}<br>
Items transportados no lote:<br>
@for($i = 0; $i <= $contador; $i++)
<li>{{$quantidadetr[$i]}} x {{$nomeproduto[$i]}} {{$nomecor[$i]}} ({{$nometamanho[$i]}})</li>
@endfor
Destino do Lote: {{$destinolote}}
</body>
</html>