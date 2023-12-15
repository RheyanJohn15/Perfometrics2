<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#7e3af2">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>401 Error-Unauthorized Access</title>
</head>
<style>
    body{
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column
    }
    body img{
        width: 10%;
    }
    @media(max-width:600px){
        body img{
             width: 40%;
        }
    }
</style>
<body>
    <img src="{{asset('images/logo.jfif')}}" alt="">
    <h1>401 Error</h1>
    <p>Unauthorized Access</p>

    <a href="{{route('login.index')}}">Go Back and login your Credentials</a>
</body>
</html>