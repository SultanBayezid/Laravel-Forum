<!DOCTYPE html>
<html>
<head>
    <title>Factor Pairs</title>
</head>
<body>
    <h1>Factor Pairs of 900900</h1>
    <ul>
        @foreach ($pairs as $pair)
            <li>{{ $pair[0] }} * {{ $pair[1] }} = 900900</li>
        @endforeach
    </ul>
</body>
</html>
