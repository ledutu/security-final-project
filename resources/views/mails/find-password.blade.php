<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset password</title>
</head>
<body>
    <h3>Enter your new password</h3>
    <p>you must enter password greater than 6 characters</p>
    <form action="{{route('updatePassword')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="user_token" value="{{$user_token}}">
        <input type="password" placeholder="New password" name="password">
        <br><br>
        <input type="password" placeholder="Confirm new password" name="password_confirm">
        <br><br>
        <input type="submit" value="Submit">
        <p>{{session('password')}}</p>
    </form>
</body>
</html>