<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfometrics Account Details</title>
</head>
<style>
    body {
        text-align: center;
    }

    img {
        max-width: 100%;
        display: block;
        margin: 0 auto;
    }
</style>
<body>
    <h3>Account Details for Perfometrics for {{$type}} User </h3>

    <p>First Name: {{$fname}}</p>
    <p>Last Name: {{$lname}} </p>
    <p>Middle Name: {{$mname}} </p>
    <p>Suffix: {{$suffix}} </p>
    <p>Username: {{$username}} </p>
    <p>Password: {{$password}} </p>
    <p>Email: {{$email}} </p>

    <br>
    <p>This message has been sent by the administrator upon your request to provide you with important account information.</p>

</body>
</html>
