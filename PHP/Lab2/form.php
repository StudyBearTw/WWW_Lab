<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>College Registration Form</title>
</head>
<body>
    <h2>College Registration Form</h2>
    <form action="process.php" method="post">
        First Name: <input type="text" name="firstname" required><br><br>
        Last Name: <input type="text" name="lastname" required><br><br>
        Telephone Number: <input type="text" name="telephone" required><br><br>
        Email: <input type="email" name="email" required><br><br>

        What is your qualification?<br>
        <input type="radio" name="qualification" value="Not yet in college" required> Not yet in college
        <input type="radio" name="qualification" value="B.Sc."> B.Sc.
        <input type="radio" name="qualification" value="B.A."> B.A.
        <input type="radio" name="qualification" value="B.Com."> B.Com.<br><br>

        <input type="submit" value="Submit">
        <input type="reset" value="Clear">
    </form>
</body>
</html>
