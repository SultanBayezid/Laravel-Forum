<!DOCTYPE html>
<html>
<head>
    <title>Pairs</title>

</head>
<body>
    <h1>Number Classification</h1>
    <form method="post" action="{{ route('problemThreeform') }}">
        @csrf
        <label for="number">Enter an integer:</label><br>
        <input type="number" id="number" name="number"><br><br>
        <button type="submit">Check Harshad Number</button>
    </form>
</body>
</html>