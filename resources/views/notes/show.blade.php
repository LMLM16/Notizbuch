<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


</head>

<body class="antialiased">
<h1>{{$note->title}} </h1>
<h2>{{$note->subtitle}} </h2>
<p>{{$note->content}} </p>
<ul>
    <li> {{$note->id}} | {{$note->description}}</li>

</ul>
<a href="/notes">Zurück</a>
</body>
</html>
