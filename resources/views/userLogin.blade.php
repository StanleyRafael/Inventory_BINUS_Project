@extends('Templates.loginStyles')

<title>User Login</title>

@section('backButton')
    <a href="/" class="btn-back">&#8592; </a>
@endsection

@section('loginBox')
    <div class="container">
        <h2>Select User</h2>
        <form action="{{ route('user.authenticate') }}" method="POST">
            @csrf
            <div class="form-group">
                <ul class="user-list">
                    @foreach ($users as $user)
                        <li>
                            <input type="radio" id="user_{{ $user->id }}" name="user_id" value="{{ $user->id }}">
                            <label for="user_{{ $user->id }}">
                                <div class="profile-picture"></div> <!-- Default profile picture -->
                                {{ $user->username }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
    </div>
@endsection
