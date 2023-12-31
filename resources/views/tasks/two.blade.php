<!DOCTYPE html>
<html>
<head>
    <title>Pairs</title>

</head>
<body>
    <h4>
    1.2 Write a program that allows a user to enter an integer and tells them if it is a deficient, perfect or
abundant number.
    </h4>
    <form method="post" action="{{ route('problemTwoform') }}">
        @csrf
        <label for="number">Enter an integer:</label><br>
        <input type="number" id="number" name="number"><br><br>
        <button type="submit">Classify</button>
    </form>
</body>
</html>
