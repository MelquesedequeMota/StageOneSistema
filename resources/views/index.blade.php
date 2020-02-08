<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.4.1.js"integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <h1>UGA UGA UGA /h1>
    <img src='imagens/uga.jpg'>
    <button type="button" data-toggle="modal" data-target="#Sugestao">
        Sugestão
    </button>

    <div class="modal fade" id="Sugestao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enviar Sugestão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <p align='center'>Digite aqui sua sugestão!</p><br>
               <textarea name='sugestaoinput' id='sugestaoinput'></textarea>
               <input type='button' value='Enviar Sugestão' onclick='enviarSugestao()'>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>
</body>
</html>

<script type='text/javascript'>
    function enviarSugestao(){
        var sugestao = document.getElementById('sugestaoinput').value;
        $('#Sugestao').modal('hide');
        $.ajax({
        type: "GET",
        url: "/enviarsugestao/",
        data: {sugestao: sugestao},
        dataType: "json",
        success: function(data) {}
        });
        alert('Sugestão Enviada com Sucesso!')
    }
</script>