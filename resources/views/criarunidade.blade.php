<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Unidade</title>
    @if($conf==1)
    <script type='text/javascript'>alert('Unidade Cadastrada com Sucesso!')</script>
    @endif

    @if($conf==2)
    <script type='text/javascript'>alert('Ocorreu um Problema, Tente Novamente!')</script>
    @endif
    
</head>
<body>
    <form method='get' action="{{route('criarunidade')}}" id='criarunidade'>
        CPF/CNPJ da Unidade: <input type='text' name='cpfcnpjunidade' id='cpfcnpjunidade' required><input type='button' onclick='valida_cpf_cnpj()' value='Verificar'>(*)<br>
            <div id='inputcpfcnpjunidade'></div>
        Nome da Unidade: <input type='text' name='nomeunidade' id='nomeunidade'><br>
        <input type='submit' name='criarunidade' value='Criar Unidade' id='criarunidade'>
    </form>
</body>
</html>

<script src='jquery-3.4.1.min.js'></script>
<script src="Inputmask-4.0.9\dist\jquery.inputmask.bundle.js" type="text/javascript"></script>
<script type='text/javascript'>
$('#cpfcnpjunidade').keydown(function() {
        $("#cpfcnpjunidade").inputmask({
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
            document.getElementById('inputcpfcnpjunidade').innerHTML = "<h5 style='color:green;''>CPF Correto!</h5>";
            verifcpfcnpj = 1;
        } else {
            document.getElementById('inputcpfcnpjunidade').innerHTML = "<h5 style='color:red;''>CPF Incorreto!</h5>";
            verifcpfcnpj = 0;
        }

    }

    function valida_cnpj(valor) {

        if (cnpj === cnpj_original) {
            document.getElementById('inputcpfcnpjunidade').innerHTML = "<h5 style='color:green;''>CNPJ Correto!</h5>";
            verifcpfcnpj = 1;
        }
        document.getElementById('inputcpfcnpjunidade').innerHTML = "<h5 style='color:red;''>CNPJ Incorreto!</h5>";
        verifcpfcnpj = 0;
    }

    function valida_cpf_cnpj() {

        var valor = document.getElementById('cpfcnpjunidade').value;

        var valida = verifica_cpf_cnpj(valor);

        valor = valor.toString();

        valor = valor.replace(/[^0-9]/g, '');

        $.ajax({
            type: "GET",
            url: "/buscarcpfcnpjunidade/",
            data: {cpfcnpjunidade: valor},
            dataType: "json",
            success: function(data) {
                if(data == 1){
                    document.getElementById('inputcpfcnpjunidade').innerHTML = "<h5 style='color:red;'>CPF/CNPJ já cadastrado no sistema!</h5>";
                }else{
                    if (valida === 'CPF') {
                    return valida_cpf(valor);
                    } else if (valida === 'CNPJ') {
                        var cnpjj = _cnpj(valor);
                        if (cnpjj == true) {
                            document.getElementById('inputcpfcnpjunidade').innerHTML = "<h5 style='color:green;''>CNPJ Correto!</h5>";
                            verifcpfcnpj = 1;
                        } else {
                            document.getElementById('inputcpfcnpjunidade').innerHTML = "<h5 style='color:red;''>CNPJ Incorreto!</h5>";
                            verifcpfcnpj = 0;
                        }
                    } else {
                        document.getElementById('inputcpfcnpjunidade').innerHTML = "<h5 style='color:red;'>Quantidade de Dígitos Incorreto!</h5>";
                    }
                }
            }
        });

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