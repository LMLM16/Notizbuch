<!DOCTYPE html> <html>
<head>
    <title></title>
</head>
<body>
<h1>Hello, World</h1>

<ul>
    @foreach ($notes as $note)
        <li>{{ $note->title }} {{ $note->subtitle }}</li>
    @endforeach
</ul>
</body>
</html>
