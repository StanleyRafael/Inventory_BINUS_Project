<!DOCTYPE html>
<html>
<head>
    <title>Gudang</title>
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
        <h1 class="inventory-title">@yield('tableTitle')</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th rowspan="2" class="number-column">No.</th>
                    <th rowspan="2" class="normal-column">Item Name</th>
                    <th rowspan="2" class="normal-column">Specification</th>
                    <th colspan="4" class="quantity-column">Quantity</th>
                    <th rowspan="2" class="normal-column">Description</th>
                    <th rowspan="2" class="normal-column2">Stock/Non-Stock</th>
                    <th rowspan="2" class="normal-column">Barcode</th>
                </tr>
                <tr>
                    <th class="quantity-column2">R.ME</th>
                    <th class="quantity-column2">Gdg 4</th>
                    <th class="quantity-column2">Gdg 12</th>
                    <th class="quantity-column2">Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Display inventory items -->
                @yield('inventory')
            </tbody>
        </table>
    </div>
</body>
</html>
