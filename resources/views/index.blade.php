<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda</title>
</head>
<body>
@if(session('success'))
    <div>{{session('success')}}</div>
@endif
@if(session('error'))
    <div>{{session('error')}}</div>
@endif
    <h1>Novo Contato</h1>
    <form action="/contacts" method="POST">
        @csrf
        <fieldset>
            <legend>Informações Pessoais</legend>
        <div>
            <input type="text" name="first_name">Primeiro Nome
        </div>
        <div>
            <input type="text" name="last_name">Ultimo Nome
        </div>
        <div>
            <input type="email" name="email">Email
        </div>
        <div>
            <input type="date" name="birth">Birthday
        </div>
        </fieldset>
        <fieldset>
            <legend>Endereço</legend>
            <div>
                <input type="text" name="street">Rua
            </div>
            <div>
                <input type="text" name="neighborhood">Bairro
            </div>
            <div>
                <input type="text" name="city">Cidade
            </div>
            <div>
                <input type="text" name="state">Estado
            </div>
            <div>
                <input type="text" name="country">País
            </div>
        </fieldset>
        <fieldset>
            <legend>Telefones</legend>
            <div>
                <input type="text" name="area_code">DDD
            </div>
<div>
            <input type="text" name="number">Número
            </div>
        </fieldset>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
