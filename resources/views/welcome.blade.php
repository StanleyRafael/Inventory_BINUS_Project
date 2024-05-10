@extends('Templates.loginStyles')

@section('loginBox')
    <body>

    <div class="container">
        <h2>Welcome!</h2>
        <p>Please select your role:</p>
        <a href="/user-login-form" class="btn">User</a>
        <a href="/adminlogin" class="btn">Admin</a>
    </div>

    </body>
@endsection
