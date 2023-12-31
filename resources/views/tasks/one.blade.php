<!-- pairs.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>List of Factor Pairs for 900900</title>
</head>
<body>
    <h1>List of Factor Pairs for 900900</h1>
    <ul>
        @foreach ($result as $pair)
            <li>{{ $pair[0] }} * {{ $pair[1] }} = {{ $pair[0] * $pair[1] }}</li>
        @endforeach
    </ul>
</body>
</html>
