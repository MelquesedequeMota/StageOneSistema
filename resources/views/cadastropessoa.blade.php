<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastrar Pessoa</title>
</head>
<body>
@if($conf == 1)
<script type='text/javascript'> alert('Pessoa Cadastrado com Sucesso!'); </script>
@endif

    <form method="get" action="{{route('criarpessoa')}}" onsubmit="return false;">
        <h3>Obrigatório(*)</h3><br>
        Nome:</div><input type="text" name="nomepessoa" id='nomepessoa' required>(*)<br>
        CPF<input type='radio' name='cpfcnpj' value='CPF' onchange='cpf()'>
        CNPJ<input type='radio' name='cpfcnpj' value='CNPJ' onchange='cnpj()'><br>
        <div id='inputcpfcnpj'></div>
        Email: <input type="text" name="emailpessoa" id='emailpessoa' required>(*)<br>
        Número de Telefone 1: <input type="text" name="fonepessoa" id='fonepessoa' required>(*)<br>
        Número de Telefone 2: <input type="text" name="fone2pessoa" id='fone2pessoa'><br>
        Número de Telefone 3: <input type="text" name="fone3pessoa" id='fone3pessoa'><br>
        Número de Telefone 4: <input type="text" name="fone4pessoa" id='fone4pessoa'><br>
        CEP: <input type="text" name="ceppessoa" id='ceppessoa' required>(*)<br>
        Endereço:<input type="text" name="enderecopessoa" id='enderecopessoa' required>(*)<br>
        Observações: <input type="text" name="obspessoa" id='obspessoa' required>(*)<br>
        Senha: <input type="password" name="senhapessoa" id='senhapessoa' required>(*)<br>
        Confirmar Senha: <input type="password" name="confsenhapessoa" id='confsenhapessoa' required>(*)
        <div id='senhas'></div><br>
        <input type="button" value="Confirmar Cadastro" onclick="validarCampo()" name='criar'>
    </form>
</body>
</html>

<script  src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js'></script>
<script type='text/javascript'>

    $('#fonepessoa').keydown(function(){
        if($("#fonepessoa").val().length < 11){
            $("#fonepessoa").mask("(99) 9999-9999")
        }else{
            $("#fonepessoa").mask("(99) 99999-9999")
        }
    });
    

    $('#fone2pessoa').keydown(function(){
        if($("#fone2pessoa").val().length < 11){
            $("#fone2pessoa").mask("(99) 9999-9999")
        }else{
            $("#fone2pessoa").mask("(99) 99999-9999")
        }
    });

    $('#fone3pessoa').keydown(function(){
        if($("#fone3pessoa").val().length < 11){
            $("#fone3pessoa").mask("(99) 9999-9999")
        }else{
            $("#fone3pessoa").mask("(99) 99999-9999")
        }
    });
    
    $('#fone4pessoa').keydown(function(){
        if($("#fone4pessoa").val().length < 11){
            $("#fone4pessoa").mask("(99) 9999-9999")
        }else{
            $("#fone4pessoa").mask("(99) 99999-9999")
        }
    });

    $('#ceppessoa').keydown(function(){
        $('#ceppessoa').mask('99999-999');
    });

    function cpf(){
        document.getElementById('inputcpfcnpj').innerHTML = "<input type='text' name='cpfcnpj' placeholder='Digite aqui o CPF' id='inputCPF'>";
        $("#inputCPF").mask("999.999.999-99");
    }
    function cnpj(){
        document.getElementById('inputcpfcnpj').innerHTML = "<input type='text' name='cpfcnpj' placeholder='Digite aqui o CNPJ' id='inputCNPJ'>";
        $("#inputCNPJ").mask("99.999.999/9999-99");
    }
    function validarCampo(){
        var cont = 0;

        if(!document.getElementById('inputCPF') && !document.getElementById('inputCNPJ')){

            document.getElementById('inputcpfcnpj').innerHTML = "<h5 style='color:red;''>É obrigatório CPF ou CNPJ</h5>";
        
        }

        if(document.getElementById('inputCNPJ')){
            if(document.getElementById('inputCNPJ').value != ''){
                cont++;
            }else{
                document.getElementById('inputcpfcnpj').innerHTML = "<h5 style='color:red;''>O campo está vazio</h5>";
            }
        }

        if(document.getElementById('inputCPF')){
            if(document.getElementById('inputCPF').value != ''){
                cont++;
            }else{
                document.getElementById('inputcpfcnpj').innerHTML = "<h5 style='color:red;''>O campo está vazio</h5>";
            }
        }

        if(document.getElementById('nomepessoa').value != ''){
            cont++;
        }

        if(document.getElementById('fonepessoa').value != ''){
            cont++;
        }

        if(document.getElementById('emailpessoa').value != ''){
            cont++;
        }
        
        if(document.getElementById('ceppessoa').value != ''){
            cont++;
        }

        if(document.getElementById('enderecopessoa').value != ''){
            cont++;
        }

        if(document.getElementById('obspessoa').value != ''){
            cont++;
        }
        if(document.getElementById('senhapessoa').value == document.getElementById('confsenhapessoa').value && document.getElementById('senhapessoa').value != '' && document.getElementById('confsenhapessoa').value != ''){
            cont++;
        }else{
            document.getElementById('senhas').innerHTML = "<h5 style='color:red;'>Senhas não estão iguais!</h5>";
        }

        alert(cont);

        if(cont === 8){
            alert(cont);
            this.submit();
        }
    }
</script>