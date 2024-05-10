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
        <h1 class="inventory-title">View Inventory</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th rowspan="2" class="number-column">No.</th>
                    <th rowspan="2" class="normal-column">Item Name</th>
                    <th rowspan="2" class="normal-column">Specification</th>
                    <th colspan="4" class="quantity-column">Quantity</th>
                    <th rowspan="2" class="normal-column">Description</th>
                    <th rowspan="2" class="normal-column2">Stock/Non-Stock</th>
                    <th rowspan="2" class="normal-column2">Visibility</th>
                    <th rowspan="2" class="normal-column">Barcode</th>
                    <th rowspan="2" class="edit-delete-column">Edit/Delete</th>
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
        <a href="{{ url('/export-inventory') }}" class="btn btn-primary" style="margin-bottom: 10px;">Download Inventory</a>

    </div>


    @yield('editItemSection')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle edit button click event
            $(document).on('click', '.edit-item', function() {
                var itemId = $(this).data('item-id');
                console.log("Edit button clicked");
                // Call the route to fetch item data
                $.get('/get-item/' + itemId, function(data) {
                    // Populate the form fields in the edit modal with the fetched data
                    $('#itemName').val(data.itemName);
                    $('#specification').val(data.specification);
                    $('#rmeQuantity').val(data.rmeQuantity);
                    $('#gudang4Quantity').val(data.gudang4Quantity);
                    $('#gudang12Quantity').val(data.gudang12Quantity);
                    $('#description').val(data.description);
                    $('#stock').val(data.stock ? '1' : '0');
                    $('#visible').val(data.visible ? '1' : '0');
                    $('#barcode').val(data.barcode);
                    // Update the action attribute of the form to include the item ID
                    $('#editItemForm').attr('action', '/edit-item/' + itemId);
                });
            });
        });
    </script>

    @yield('deleteItemSection')
    <script>
        $(document).ready(function() {
            // When the delete button is clicked, set the item id and show the delete modal
            $('.delete-item').click(function() {
                var itemId = $(this).data('item-id');
                // Set the action attribute of the form to the delete route with the item id
                $('#deleteForm').attr('action', '/delete-item/' + itemId);
                // Show the delete confirmation modal
                $('#deleteItemModal').modal('show');
            });

            // When the delete confirmation button is clicked, submit the delete form
            $('#confirmDelete').click(function() {
                // Submit the form
                $('#deleteForm').submit();
            });
        });
    </script>

    @yield('addItemSection')
</body>
</html>
