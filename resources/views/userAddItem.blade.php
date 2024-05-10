@extends('Templates.userInventoryTemplate2')
@extends('Templates.userTabs')

@section('tableTitle')
    Input/Take Item
@endsection

{{-- @section('content')
    @section('inventory')
        @foreach ($inventory->sortBy('itemName') as $item)
            @if($item->visible)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> <input type="text" id="itemSearch" placeholder="Search for an item..."></td>
                    <td>{{$item->rmeQuantity}}</td>
                    <td>{{$item->gudang4Quantity}}</td>
                    <td>{{$item->gudang12Quantity}}</td>
                    <td><strong>{{$item->rmeQuantity + $item->gudang4Quantity + $item->gudang12Quantity}}</strong></td>
                    <td>{{$item->keperluan}}</td>
                </tr>
            @endif
        @endforeach
    @endsection
@endsection --}}


@section('inventory')
    <tr>
        <td class="number-column">1</td>
        <td class="normal-column"><input type="text" class="itemSearch" placeholder="Search for an item..."></td>
        <td class="quantity-column2"><input type="number" class="quantityInput" id="rmeQuantity_1" placeholder="RME Quantity"></td>
        <td class="quantity-column2"><input type="number" class="quantityInput" id="gudang4Quantity_1" placeholder="Gudang 4 Quantity"></td>
        <td class="quantity-column2"><input type="number" class="quantityInput" id="gudang12Quantity_1" placeholder="Gudang 12 Quantity"></td>
        <td class="quantity-column2"></td>
        <td class="normal-column"><input type="text" class="quantityInput" id="reason_1" placeholder="Keperluan"></td>
    </tr>
@endsection


@section('otherContent')
    <button id="updateQuantitiesButton" class="btn btn-primary" style="position: fixed; bottom: 20px; right: 20px;" >
        Finish & Submit
    </button>
@endsection

{{-- @section('addItemSection')
    <!-- Modal for Add Item-->
    <!-- Modal -->
    <div class="modal fade" id="userAddItemModal" tabindex="-1" role="dialog" aria-labelledby="userAddItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userAddItemModalLabel">Add Item</h5>
                    <h6 class="modal-title" id="itemNameTitle"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.action.additem') }}" id="addForm">
                        @csrf
                        <input type="hidden" id="itemId" name="itemId">
                        <div class="form-group">
                            <label for="warehouse">Which warehouse are you adding the item to?</label>
                            <select class="form-control" id="warehouse" name="warehouse">
                                <option value="R.ME">R.ME</option>
                                <option value="Gudang 4">Gudang 4</option>
                                <option value="Gudang 12">Gudang 12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="itemQuantity">How many items would you like to add?</label>
                            <input type="number" class="form-control" id="itemQuantity" name="itemQuantity">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="confirmAdd">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

