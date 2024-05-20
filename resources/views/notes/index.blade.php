<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


</head>

<body class="antialiased">
<h1>My Notes</h1>
<ul>
    @foreach ($notes as $note)
        <li> {{$note ->id}} | <h3><a href="/books/{{$note->id}}">{{$note->title}}</a></h3></li>
    @endforeach
</ul>
</body>
</html>
