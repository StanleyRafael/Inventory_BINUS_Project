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

        /* Hide the helper because it's not being implemented correctly for now */
        .ui-helper-hidden-accessible {
            display: none !important;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div class="container-fluid">
        <h1 class="inventory-title">@yield('tableTitle')</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th rowspan="2" class="number-column">No.</th>
                    <th rowspan="2" class="normal-column">Item Name</th>
                    <th colspan="4" class="quantity-column">Quantity</th>
                    <th rowspan="2" class="normal-column">Keperluan</th>
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

    @yield('otherContent')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        var itemIdArray = [];
        $(document).ready(function() {
            var items = @json($inventory->sortBy('itemName')->where('visible', true)->pluck('itemName'));

            var autocompleteOptions = {
                source: items,
                select: function(event, ui) {
                    var item = ui.item.value;
                    var itemData = JSON.parse('@json($inventory->sortBy('itemName')->where('visible', true))');
                    var itemDataArray = Object.values(itemData);
                    var selectedItemData = itemDataArray.find(function(i) {
                        return i.itemName === item;
                    });

                    var rowIndex = $('tbody tr').length;

                    // Add the itemId value to the array
                    itemIdArray.push(selectedItemData.id);
                    console.log(itemIdArray);

                    var newRow = `
                        <tr>
                            <td class="number-column">${$('tbody tr').length + 1}</td>
                            <td class="normal-column"><input type="text" class="itemSearch" placeholder="Search for an item..."></td>
                            <td class="quantity-column2"><input type="number" class="quantityInput" id="rmeQuantity_${$('tbody tr').length + 1}" placeholder="RME Quantity"></td>
                            <td class="quantity-column2"><input type="number" class="quantityInput" id="gudang4Quantity_${$('tbody tr').length + 1}" placeholder="Gudang 4 Quantity"></td>
                            <td class="quantity-column2"><input type="number" class="quantityInput" id="gudang12Quantity_${$('tbody tr').length + 1}" placeholder="Gudang 12 Quantity"></td>
                            <td class="quantity-column2"></td>
                            <td class="normal-column"><input type="text" class="quantityInput" id="reason_${$('tbody tr').length + 1}" placeholder="Keperluan"></td>
                        </tr>
                    `;

                    $('tbody').append(newRow);
                    $('.itemSearch').last().autocomplete(autocompleteOptions);

                    // Add event listener to quantity input fields to handle quantity adjustments
                    $('.quantityInput').on('change', function() {
                        updateTotalQuantity($(this).closest('tr'));
                    });

                }
            };


            $('.itemSearch').autocomplete(autocompleteOptions);
        });

        function updateTotalQuantity(row) {
            var rmeQuantity = parseInt(row.find('td').eq(2).find('.quantityInput').val()) || 0;
            var gudang4Quantity = parseInt(row.find('td').eq(3).find('.quantityInput').val()) || 0;
            var gudang12Quantity = parseInt(row.find('td').eq(4).find('.quantityInput').val()) || 0;

            var totalQuantity = rmeQuantity + gudang4Quantity + gudang12Quantity;

            row.find('td').eq(5).text(totalQuantity);
        }

        $('#updateQuantitiesButton').on('click', function() {
            updateQuantities();
            console.log("Finish and submit button clicked.");
        });

        function updateQuantities() {
            var data = {};

            data['itemIdArray'] = itemIdArray;

            $('tbody tr').slice(0, -1).each(function(index, row) {
                var itemId = 'itemId_' + (index + 1); // Dynamically generate item ID
                var rmeQuantity = $(row).find('td').eq(2).find('.quantityInput').val() || 0;
                var gudang4Quantity = $(row).find('td').eq(3).find('.quantityInput').val() || 0;
                var gudang12Quantity = $(row).find('td').eq(4).find('.quantityInput').val() || 0;
                var reason = $(row).find('td').eq(6).find('.quantityInput').val() || '';

                data[itemId] = { // Use the dynamically generated item ID as the key
                    rmeQuantity: rmeQuantity,
                    gudang4Quantity: gudang4Quantity,
                    gudang12Quantity: gudang12Quantity,
                    reason: reason
                };
            });

            console.log(data);

            // Send data to backend for processing
            $.ajax({
                url: '/update-quantities',
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

    <!-- Old add item function, not used -->
    {{-- @yield('addItemSection')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.user-add-item').on('click', function() {
                var itemId = $(this).data('item-id');
                $('#itemId').val(itemId);
                console.log("Add button clicked");
            });

            $('#confirmAdd').click(function() {
                // Submit the form
                $('#addForm').submit();
            });
        });
    </script>

    @yield('takeItemSection')
    <script>
        $(document).ready(function() {
            $('.user-take-item').on('click', function() {
                var itemId = $(this).data('item-id');
                $('#itemId').val(itemId);
                console.log("Take button clicked");
            });

            $('#confirmTake').click(function() {
                // Submit the form
                $('#takeForm').submit();
            });
        });
    </script> --}}

</body>
</html>
