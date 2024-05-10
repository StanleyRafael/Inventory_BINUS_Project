@extends('Templates.opnameTemplate')
@extends('Templates.adminTabs')

@section('content')
    @section('inventory')
        @foreach ($inventory as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->itemName}}</td>
                <td>{{$item->specification}}</td>
                <td>{{$item->rmeQuantity}}</td>
                <td>{{$item->gudang4Quantity}}</td>
                <td>{{$item->gudang12Quantity}}</td>
                <td><strong>{{$item->rmeQuantity + $item->gudang4Quantity + $item->gudang12Quantity}}</strong></td>
                <td class="quantity-column2"><input type="number" class="quantityInput" id="rmeQuantity_{{$loop->iteration}}" placeholder="RME Quantity" value="{{$item->rmeQuantity}}"></td>
                <td class="quantity-column2"><input type="number" class="quantityInput" id="gudang4Quantity_{{$loop->iteration}}" placeholder="Gudang 4 Quantity" value="{{$item->gudang4Quantity}}"></td>
                <td class="quantity-column2"><input type="number" class="quantityInput" id="gudang12Quantity_{{$loop->iteration}}" placeholder="Gudang 12 Quantity" value="{{$item->gudang12Quantity}}"></td>
                <td class="total-quantity"></td>
                <td class="updated-quantity"></td>
            </tr>
        @endforeach
    @endsection
        <button id="updateOpnameButton" class="btn btn-primary" style="position: fixed; bottom: 20px; right: 20px;" >
            Finish & Submit
        </button>
@endsection


