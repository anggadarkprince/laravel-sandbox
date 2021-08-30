<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new Tweet</title>
</head>
<body>
@if(Session::has('status'))
    <p class="alert alert-{{ Session::get('status') }}">{{ Session::get('message') }}</p>
@endif
<form action="{{ url('auth') }}" method="post">
    @csrf
    <div>
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" placeholder="Your email" maxlength="100">
    </div>
    <div>
        <label for="password">Password</label><br>
        <input type="text" name="password" id="password" placeholder="Your password" maxlength="100">
    </div>
    <button type="submit">Login</button>
</form>
</body>
</html>
