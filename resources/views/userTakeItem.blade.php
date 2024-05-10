@extends('Templates.userInventoryTemplate2')
@extends('Templates.userTabs')

@section('tableTitle')
    Take Item
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
                    <td>
                        <button class="btn btn-primary user-take-item" data-toggle="modal" data-target="#userTakeItemModal" data-item-id="{{ $item->id }}">Take</button>
                    </td>
                </tr>
            @endif
        @endforeach
    @endsection
@endsection

@section('logoutButton')
    <li class="nav-item">
        <form action="{{ route('user.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link nav-link">Logout</button>
        </form>
    </li>
@endsection

@section('takeItemSection')
    <!-- Modal for Taking Item-->
    <!-- Modal -->
    <div class="modal fade" id="userTakeItemModal" tabindex="-1" role="dialog" aria-labelledby="userTakeItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userTakeItemModalLabel">Take Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.action.takeitem') }}" id="takeForm">
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
                            <label for="itemQuantity">How many items would you like to take?</label>
                            <input type="number" class="form-control" id="itemQuantity" name="itemQuantity">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="confirmTake">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection

