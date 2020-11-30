<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('confirmResetPassword')}}" method="GET">
        <input type="hidden" name="user_token" value="{{$user->user_token}}">
        <h3>Do you want to reset password?</h3>
        <p>Your full name: {{$user->full_name}}</p>
        <p>Your email: {{$user->email}}</p>
        <input type="submit" value="Confirm">
    </form>
</body>
</html>