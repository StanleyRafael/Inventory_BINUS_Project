<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .profile-picture {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ccc;
            margin-left: auto; /* Aligns the profile picture to the right */
            margin-right: 10px;
            margin-top: 10px;
            display: inline-block;
            vertical-align: middle;
            position: relative;
            top: -5px;
            cursor: pointer; /* Add cursor pointer to indicate it's clickable */
        }

        .nav-item.active {
            background-color: #3a9cff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            background-image: linear-gradient(to bottom, #3a9cff, #60a1fb);
        }
        .navbar-divider {
            border-bottom: 1px solid #000000;
            margin-bottom: 20px;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .navbar-brand {
            animation: colorChange 4s infinite alternate;
        }

        /* Keyframes for color change */
        @keyframes colorChange {
            0% {
                outline-color: black;
            }
            100% {
                outline-color: rgb(42, 114, 214); /* Change to your desired color */
            }
        }

        @keyframes shimmer {
            0% {
                outline-color: red;
            }
            16% {
                outline-color: rgb(107, 79, 23);
            }
            32% {
                outline-color: rgb(143, 0, 164);
            }
            48% {
                outline-color: green;
            }
            64% {
                outline-color: blue;
            }
            80% {
                outline-color: indigo;
            }
            100% {
                outline-color: violet;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="{{ asset('images/Staventory.png') }}" alt="Staventory Logo" width="100" height="auto" style="outline: 2px solid black; animation: shimmer 4s infinite alternate;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto" style="padding-left: 10px;"> <!-- 'mr-auto' class to push the items to the left -->
            <li class="nav-item {{ Request::is('user-inventory') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.inventory') }}">Inventory</a>
            </li>
            <li class="nav-item {{ Request::is('user-add-item-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.additem') }}">Input/Take Item</a>
            </li>
            <li class="nav-item {{ Request::is('user-logs') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.logs') }}">Logs</a>
            </li>
        </ul>

        <!-- Profile picture dropdown -->
        <div class="dropdown">
            <div class="profile-picture" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="navbar-divider"></div>

<div class="container">
    @yield('content')
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
