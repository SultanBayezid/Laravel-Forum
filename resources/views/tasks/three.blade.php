<!DOCTYPE html>
<html>
<head>
    <title>Pairs</title>

</head>
<body>
   <h2>
   1.3 Write a program that allows a user to enter an integer and tells them if it is a Harshad number (base
10).
   </h2>
    <form method="post" action="{{ route('problemThreeform') }}">
        @csrf
        <label for="number">Enter an integer:</label><br>
        <input type="number" id="number" name="number"><br><br>
        <button type="submit">Check Harshad Number</button>
    </form>
</body>
</html>
