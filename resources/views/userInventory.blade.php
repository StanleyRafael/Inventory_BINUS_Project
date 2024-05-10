@extends('Templates.userInventoryTemplate')
@extends('Templates.userTabs')

@section('tableTitle')
    Inventory
@endsection

@section('content')
    @section('inventory')
        @foreach ($inventory->sortBy('itemName') as $item)
            @if($item->visible)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->itemName}}</td>
                    <td>{{$item->specification}}</td>
                    <td>{{$item->rmeQuantity}}</td>
                    <td>{{$item->gudang4Quantity}}</td>
                    <td>{{$item->gudang12Quantity}}</td>
                    <td><strong>{{$item->rmeQuantity + $item->gudang4Quantity + $item->gudang12Quantity}}</strong></td>
                    <td>{{ \Illuminate\Support\Str::limit($item->description, 20) }}</td>
                    <td>{{$item->stock ? 'stock' : 'non-stock'}}</td>
                    <td>{{$item->barcode}}</td>
                </tr>
            @endif
        @endforeach
    @endsection
@endsection

