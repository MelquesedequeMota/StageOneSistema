<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cadastrar Pessoa</title>
</head>

<body>
    @if($conf == 1)
    <script type='text/javascript'>
        alert('Pessoa Cadastrado com Sucesso!');
    </script>
    @endif

    @if($conf == 2)
    <script type='text/javascript'>
        alert('Não foi possível conectar ao servidor, tente novamente!');
    </script>
    @endif

    @if($mensagemerro != '')
    <script type='text/javascript'>
        alert({{$mensagemerro}});
    </script>
    @endif

    <form method="get" action="{{route('criarpessoa')}}" onsubmit="return false;" id='criarpessoa'>
        <h3>Obrigatório(*)</h3><br>
        Nome:</div><input type="text" name="nomepessoa" id='nomepessoa' required>(*)<br>
        CPF/CNPJ<input type='text' name='cpfcnpj' id='cpfcnpj' required><input type='button' onclick='valida_cpf_cnpj()' value='Verificar'>(*)<br>
        <div id='inputcpfcnpj'></div>
        Email: <input type="text" name="emailpessoa" id='emailpessoa' required>(*)<br>
        Número de Telefone 1: <input type="text" name="fonepessoa" id='fonepessoa' required>(*)
        <div id='msgemail'></div>
        Número de Telefone 2: <input type="text" name="fone2pessoa" id='fone2pessoa'><br>
        Número de Telefone 3: <input type="text" name="fone3pessoa" id='fone3pessoa'><br>
        Número de Telefone 4: <input type="text" name="fone4pessoa" id='fone4pessoa'><br>
        CEP: <input type="text" name="ceppessoa" id='ceppessoa' required>(*)
        <div id='msgcep'></div>
        Endereço:<input type="text" name="enderecopessoa" id='enderecopessoa' required>(*)<br>
        Observações: <input type="text" name="obspessoa" id='obspessoa'><br>
        Senha: <input type="password" name="senhapessoa" id='senhapessoa' required>(*)<br>
        Confirmar Senha: <input type="password" name="confsenhapessoa" id='confsenhapessoa' required>(*)
        <div id='senhas'></div><br>
        <input type="button" value="Confirmar Cadastro" onclick="validarCampo()">
    </form>
</body>

</html>
<script src='jquery-3.4.1.min.js'></script>
<script src="Inputmask-4.0.9\dist\jquery.inputmask.bundle.js" type="text/javascript"></script>
<script type='text/javascript'>
    var verifcpfcnpj = 0;

    $('#fonepessoa').keydown(function() {
        $("#fonepessoa").inputmask({
            mask: ["(99) 9999-9999", "(99) 99999-9999"],
            keepStatic: true
        });
    });


    $('#fone2pessoa').keydown(function() {
        $("#fone2pessoa").inputmask({
            mask: ["(99) 9999-9999", "(99) 99999-9999"],
            keepStatic: true
        });
    });

    $('#fone3pessoa').keydown(function() {
        $("#fone3pessoa").inputmask({
            mask: ["(99) 9999-9999", "(99) 99999-9999"],
            keepStatic: true
        });
    });

    $('#fone4pessoa').keydown(function() {
        $("#fone4pessoa").inputmask({
            mask: ["(99) 9999-9999", "(99) 99999-9999"],
            keepStatic: true
        });
    });

    $('#ceppessoa').keydown(function() {
        $("#ceppessoa").inputmask({
            mask: ["99.999-999"],
            keepStatic: true
        });
    });

    $('#cpfcnpj').keydown(function() {
        $("#cpfcnpj").inputmask({
            mask: ["999.999.999-99", "99.999.999/9999-99"],
            keepStatic: true
        });
    });

    function validarCampo() {
        var cont = 0;

        valida_cpf_cnpj();

        if (verifcpfcnpj == 1) {
            cont++;
        }

        if (document.getElementById('nomepessoa').value != '') {
            cont++;
        }

        if (document.getElementById('fonepessoa').value != '') {
            cont++;
        }

        if (document.getElementById('emailpessoa').value != '') {
            var email = document.getElementById('emailpessoa');
            usuario = email.value.substring(0, email.value.indexOf("@"));
            dominio = email.value.substring(email.value.indexOf("@") + 1, email.value.length);

            if ((usuario.length >= 1) &&
                (dominio.length >= 3) &&
                (usuario.search("@") == -1) &&
                (dominio.search("@") == -1) &&
                (usuario.search(" ") == -1) &&
                (dominio.search(" ") == -1) &&
                (dominio.search(".") != -1) &&
                (dominio.indexOf(".") >= 1) &&
                (dominio.lastIndexOf(".") < dominio.length - 1)) {
                    document.getElementById("msgemail").innerHTML = "";
                    cont++;
            } else {
                document.getElementById("msgemail").innerHTML = "<h5 style='color:red;'>Email Inválido!</h5>";
            }
            
        }

        if (document.getElementById('ceppessoa').value != '') {
            var cep = document.getElementById('ceppessoa').value;

            if (cep.length == 10) {
                document.getElementById("msgcep").innerHTML = "";
                cont++;
            }
            else {        
                document.getElementById("msgcep").innerHTML = "<h5 style='color:red;'>CEP Inválido!</h5>";
            };  
        }

        if (document.getElementById('enderecopessoa').value != '') {
            cont++;
        }

        if (document.getElementById('senhapessoa').value == document.getElementById('confsenhapessoa').value && document.getElementById('senhapessoa').value != '' && document.getElementById('confsenhapessoa').value != '') {
            cont++;
            document.getElementById('senhas').innerHTML = "";
        } else {
            document.getElementById('senhas').innerHTML = "<h5 style='color:red;'>Senhas não estão iguais!</h5>";
        }

        if (cont === 7) {
            document.getElementById('criarpessoa').submit();
        }
    }


    function verifica_cpf_cnpj(valor) {

        valor = valor.toString();
        valor = valor.replace(/[^0-9]/g, '');
        if (valor.length === 11) {
            return 'CPF';
        } else if (valor.length === 14) {
            return 'CNPJ';
        } else {
            return false;
        }

    }


    function calc_digitos_posicoes(digitos, posicoes = 10, soma_digitos = 0) {

        digitos = digitos.toString();

        for (var i = 0; i < digitos.length; i++) {

            soma_digitos = soma_digitos + (digitos[i] * posicoes);

            posicoes--;

            if (posicoes < 2) {

                posicoes = 9;
            }
        }

        soma_digitos = soma_digitos % 11;

        if (soma_digitos < 2) {
            soma_digitos = 0;
        } else {
            soma_digitos = 11 - soma_digitos;
        }

        var cpf = digitos + soma_digitos;

        return cpf;

    }

    function valida_cpf(valor) {

        valor = valor.toString();

        valor = valor.replace(/[^0-9]/g, '');

        var digitos = valor.substr(0, 9);

        var novo_cpf = calc_digitos_posicoes(digitos);

        var novo_cpf = calc_digitos_posicoes(novo_cpf, 11);

        if (novo_cpf === valor) {
            document.getElementById('inputcpfcnpj').innerHTML = "<h5 style='color:green;''>CPF Correto!</h5>";
            verifcpfcnpj = 1;
        } else {
            document.getElementById('inputcpfcnpj').innerHTML = "<h5 style='color:red;''>CPF Incorreto!</h5>";
            verifcpfcnpj = 0;
        }

    }

    function valida_cnpj(valor) {

        if (cnpj === cnpj_original) {
            document.getElementById('inputcpfcnpj').innerHTML = "<h5 style='color:green;''>CNPJ Correto!</h5>";
            verifcpfcnpj = 1;
        }
        document.getElementById('inputcpfcnpj').innerHTML = "<h5 style='color:red;''>CNPJ Incorreto!</h5>";
        verifcpfcnpj = 0;
    }

    function valida_cpf_cnpj() {

        var valor = document.getElementById('cpfcnpj').value;

        var valida = verifica_cpf_cnpj(valor);

        valor = valor.toString();

        valor = valor.replace(/[^0-9]/g, '');

        if (valida === 'CPF') {
            return valida_cpf(valor);
        } else if (valida === 'CNPJ') {
            var cnpjj = _cnpj(valor);
            if (cnpjj == true) {
                document.getElementById('inputcpfcnpj').innerHTML = "<h5 style='color:green;''>CNPJ Correto!</h5>";
                verifcpfcnpj = 1;
            } else {
                document.getElementById('inputcpfcnpj').innerHTML = "<h5 style='color:red;''>CNPJ Incorreto!</h5>";
                verifcpfcnpj = 0;
            }
        } else {
            document.getElementById('cpfcnpj').innerHTML = "<h5 style='color:red;'>Quantidade de Dígitos Incorreto!</h5>";
        }

    }

    function _cnpj(cnpj) {

        cnpj = cnpj.replace(/[^\d]+/g, '');

        if (cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999")
            return false;


        tamanho = cnpj.length - 2
        numeros = cnpj.substring(0, tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)) return false;
        tamanho = tamanho + 1;
        numeros = cnpj.substring(0, tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;

        return true;

    }
</script>