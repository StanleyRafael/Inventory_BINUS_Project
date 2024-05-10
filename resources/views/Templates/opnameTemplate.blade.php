<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Stock Opname</title>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div class="container-fluid">
        <h1 class="inventory-title">Stock Opname</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th rowspan="2" class="number-column">No.</th>
                    <th rowspan="2" class="normal-column">Item Name</th>
                    <th rowspan="2" class="normal-column">Specification</th>
                    <th colspan="4" class="quantity-column">Quantity</th>
                    <th colspan="4" class="quantity-column">Updated Quantity</th>
                    <th rowspan="2" class="number-column">Selisih</th>
                </tr>
                <tr>
                    <th class="quantity-column2">R.ME</th>
                    <th class="quantity-column2">Gdg 4</th>
                    <th class="quantity-column2">Gdg 12</th>
                    <th class="quantity-column2">Total</th>
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        var itemIdArray = [];

        $(document).ready(function() {
            // Populate itemIdArray with item IDs from database
            @foreach ($inventory as $item)
                itemIdArray.push({{ $item->id }});
            @endforeach

            // Call updateTotalQuantity for each row to calculate initial totals
            $('tr').each(function(index) {
                updateTotalQuantity($(this));
            });

            // Attach input event handler to update totals on input change
            $('.quantityInput').on('input', function() {
                var row = $(this).closest('tr');
                updateTotalQuantity(row);
            });

            $('#updateOpnameButton').on('click', function() {
                updateQuantities();
            });
        });

        function updateTotalQuantity(row) {
            var rmeQuantity = parseInt(row.find('.quantityInput[id^="rmeQuantity"]').val()) || 0;
            var gudang4Quantity = parseInt(row.find('.quantityInput[id^="gudang4Quantity"]').val()) || 0;
            var gudang12Quantity = parseInt(row.find('.quantityInput[id^="gudang12Quantity"]').val()) || 0;

            var totalQuantity = rmeQuantity + gudang4Quantity + gudang12Quantity;

            row.find('.total-quantity').html('<strong>' + totalQuantity + '</strong>');

            var initialQuantity = parseInt(row.find('td:nth-child(7)').text());
            var updatedQuantity = initialQuantity - totalQuantity;
            row.find('.updated-quantity').html('<strong>' + updatedQuantity + '</strong>');
        }

        function updateQuantities() {
            var data = {};

            data['itemIdArray'] = itemIdArray;

            $('tbody tr').each(function(index, row) {
                var itemId = itemIdArray[index]; // Get the item ID from the array
                var rmeQuantity = $(row).find('.quantityInput[id^="rmeQuantity"]').val() || 0;
                var gudang4Quantity = $(row).find('.quantityInput[id^="gudang4Quantity"]').val() || 0;
                var gudang12Quantity = $(row).find('.quantityInput[id^="gudang12Quantity"]').val() || 0;

                data[itemId] = { // Use the item ID as the key
                    rmeQuantity: rmeQuantity,
                    gudang4Quantity: gudang4Quantity,
                    gudang12Quantity: gudang12Quantity
                };
            });

            console.log(data);

            // Send data to backend for processing
            $.ajax({
                url: '/update-opname',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json', // Set content type to JSON
                data: JSON.stringify(data), // Send the constructed data object
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert(xhr.responseJSON.error);
                }
            });
        }
    </script>

</body>
</html>
