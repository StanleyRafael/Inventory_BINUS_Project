<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            border: 1px solid #ccc;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-back {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 18px;
            text-decoration: none;
            color: #fff;
            background-color: #465d74;
            padding: 10px 20px;
            border-radius: 5px;
        }


        .user-dropdown {
            width: 100%;
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            background-color: #d8ffce;
        }

        .profile-picture {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ccc;
            margin-right: 10px;
            display: inline-block;
            vertical-align: middle;
            position: relative;
            top: -5px;
        }

        .user-list {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap; /* Allow items to wrap to the next row */
            justify-content: center; /* Center the items horizontally */
        }

        .user-list li {
            margin-right: 10px;
            margin-bottom: 10px;
            flex: 0 0 calc(20% - 10px); /* Each item takes up 20% width with some spacing */
        }

        .user-list li input[type="radio"] {
            display: none; /* Hide the radio button */
        }

        .user-list li label {
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #ccc;
            cursor: pointer;
            width: 100%;
        }

        /* Style when label is checked */
        .user-list li input[type="radio"]:checked + label {
            background-color: #3a9cff; /* Change this to your desired active color */
            color: #fff; /* Change this to your desired text color */
        }

    </style>
</head>
<body>
    @yield('backButton')
    @yield('loginBox')
</body>
</html>
