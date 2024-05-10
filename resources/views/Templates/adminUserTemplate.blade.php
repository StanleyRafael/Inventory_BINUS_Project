<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .inventory-title {
            color: #007bff;
            font-size: 45px;
            margin-bottom: 20px;
        }

        .normal-column {
            width: 200px;
            vertical-align: middle
        }

        .normal-column2 {
            width: 80px;
            vertical-align: middle
        }

        .quantity-column {
            padding: 0.25rem 0;
            margin: 0;
            text-align: center;
            font-size: 14px;
        }

        .quantity-column2 {
            width: 75px;
            padding: 0.25rem 0;
            margin: 0;
            font-size: 14px;
        }

        .number-column {
            width: 40px;
            padding: 0.25rem 0;
            margin: 0;
            font-size: 14px;
        }

        .edit-delete-column {
            width: 120px;
            padding: 0.25rem 0;
            margin: 0;
            font-size: 14px;
        }

        th, td {
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h1 class="inventory-title">User List</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th rowspan="2" class="number-column">No.</th>
                    <th rowspan="2" class="normal-column">Username</th>
                    <th rowspan="2" class="edit-delete-column">Delete</th>
                </tr>
            </thead>
            <tbody>
                <!-- Display user list -->
                @yield('userTable')
            </tbody>
        </table>
    </div>

    @yield('addUserSection')

    @yield('deleteItemSection')
    <script>
        $(document).ready(function() {
            $('.delete-user').click(function() {
                var userId = $(this).data('user-id');
                $('#deleteForm').attr('action', '/delete-user/' + userId);
                $('#deleteUserModal').modal('show');
            });

            $('#confirmDelete').click(function() {
                $('#deleteForm').submit();
            });
        });
    </script>
</body>
</html>
