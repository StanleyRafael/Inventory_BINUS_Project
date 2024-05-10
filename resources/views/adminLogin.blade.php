@extends('Templates.loginStyles')

<title>Admin Login</title>

@section('backButton')
    <a href="/" class="btn-back">&#8592; </a>
@endsection

@section('loginBox')
    <body>
        <div class="container">
            <h2>Admin Login</h2>
            <form action="{{ route('admin.authenticate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </body>
@endsection
