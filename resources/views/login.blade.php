<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

@if($conf == 2)
<script type='text/javascript'>alert('Usuário ou Senha Incorretos!')</script>
@endif

<form method='get' action="{{route('login')}}">
<input type='text' name='cpfcnpjpessoa'>
<input type='password' name='senhapessoa'>
<input type='submit' name='logar'>
</form>
    
</body>
</html>