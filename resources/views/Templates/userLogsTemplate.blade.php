<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
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
        <h1 class="inventory-title">Logs</h1>

        <form method="GET" action="{{ route('user.logFilter') }}">
            <div class="form-group">
                <label for="month">Select Month:</label>
                <select id="month" name="month" class="form-control">
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-bottom: 20px;">Filter</button>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th rowspan="2" class="number-column">No.</th>
                    <th rowspan="2" class="normal-column">Username</th>
                    <th rowspan="2" class="normal-column">Item Name</th>
                    <th colspan="4" class="quantity-column">Quantity</th>
                    <th rowspan="2" class="normal-column">Reason</th>
                    <th rowspan="2" class="normal-column">Date & Time</th>

                </tr>
                <tr>
                    <th class="quantity-column2">R.ME</th>
                    <th class="quantity-column2">Gdg 4</th>
                    <th class="quantity-column2">Gdg 12</th>
                    <th class="quantity-column2">Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Display filtered logs here -->
                @yield('tableContent')
            </tbody>
        </table>
    </div>

</body>
</html>
