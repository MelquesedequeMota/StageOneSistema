<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

<form method='get' action="{{route('login')}}" onsubmit="return false;" id='loginform'>
<div id='errologin'></div>
CPF: <input type='text' name='cpfcnpjpessoa' id='cpfcnpjpessoa'><br>
Senha: <input type='password' name='senhapessoa'><br>
<input type='button' name='logar' onclick='validar()' value='Logar'>
</form>
    
</body>
</html>

@if($conf == 2)
<script>document.getElementById('errologin').innerHTML = "<font color='red'>CPF/CNPJ ou Senhas Incorretos</font>";</script>
@endif

<script src='jquery-3.4.1.min.js'></script>
<script src="Inputmask-4.0.9\dist\jquery.inputmask.bundle.js" type="text/javascript"></script>
<script type='text/javascript'>

$('#cpfcnpjpessoa').keydown(function() {
        $("#cpfcnpjpessoa").inputmask({
            mask: ["999.999.999-99", "99.999.999/9999-99"],
            keepStatic: true
        });
    });

    function validar(){
        cpfcnpj = document.getElementById('cpfcnpjpessoa').value;
        cpfcnpj = cpfcnpj.replace(/[^0-9]/g, '');
        if(cpfcnpj.length == 11 || cpfcnpj == 14){
            document.getElementById('loginform').submit();
        }else{
            document.getElementById('errologin').innerHTML = "<font color='red'>CPF/CNPJ Incorreto!</font>";
        }
    }
</script>