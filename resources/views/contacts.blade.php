<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@if(session('error'))
    <div>{{session('error')}}</div>
@endif
<ul>
    @foreach($contacts as $contact)
        <li>{{$contact->first_name}} {{$contact->last_name}}</li>
        <li>{{$contact->email}}</li>
    @endforeach
</ul>
</body>
</html>
