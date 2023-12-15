<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfometrics Recovery Code</title>
</head>
<style>
    body {
        text-align: center;
    }

</style>
<body>
    @if ($type==='Student')
    <h3>Dear {{$name}}({{$type}})-LRN: {{$username}}</h3> 
    @elseif($type==='Teacher')
    <h3>Dear {{$name}}({{$type}})-Teacher Username: {{$username}}</h3>
    @else
    <h3>Dear {{$name}}({{$type}})-Coordinator Username: {{$username}}</h3> 
    @endif
    
    <p>We received a request to reset your password for your account at Perfometrics. To ensure the security of your account, we have generated a recovery code for you. Please use the following code to reset your password:</p>
    <p>Please use the following verification code to complete the verification process:</p>
     <h3>Recovery Code: {{$verificationCode}}</h3>
   <p>This code is valid for a limited time and should be used as soon as possible. If you did not request this password reset or have any concerns about the security of your account, please contact our support team immediately at [School Mail].</p>
</body>
</html>
