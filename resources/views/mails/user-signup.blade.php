<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm</title>
</head>
<body>
    <h2>Please comfirm to login</h2>
    <form role="form" action="{{route('confirmEmailSignUp')}}" method="GET">
        <input type="hidden" name="user_token" value="{{$user->user_token}}">
        <p>Full Name: {{$user->full_name}}</p>
        <p>email: {{$user->email}}</p>
        <button type="submit" class="btn btn-primary">Confirm</button>
    </form>
</body>
</html>