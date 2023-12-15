<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfometrics Message</title>
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
    <h3>Dear {{$fullname}}</h3>

    <p>Message: {{$messages}}</p>

    <br>
    <p>Yours Truly,</p>
    <p>Admin</p>

</body>
</html>
