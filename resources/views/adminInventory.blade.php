@extends('Templates.inventoryTemplate')
@extends('Templates.adminTabs')

@section('content')
    @section('inventory')
        @foreach ($inventory->sortBy('itemName') as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->itemName}}</td>
                <td>{{$item->specification}}</td>
                <td>{{$item->rmeQuantity}}</td>
                <td>{{$item->gudang4Quantity}}</td>
                <td>{{$item->gudang12Quantity}}</td>
                <td><strong>{{$item->rmeQuantity + $item->gudang4Quantity + $item->gudang12Quantity}}</strong></td>                <td>{{ \Illuminate\Support\Str::limit($item->description, 20) }}</td>
                <td>{{$item->stock ? 'stock' : 'non-stock'}}</td>
                <td>{{$item->visible ? 'visible' : 'invisible'}}</td>
                <td>{{$item->barcode}}</td>
                <td>
                    <button class="btn btn-primary edit-item" data-toggle="modal" data-target="#editItemModal" data-item-id="{{ $item->id }}">Edit</button>
                    <button class="btn btn-danger delete-item" data-toggle="modal" data-target="#deleteItemModal" data-item-id="{{ $item->id }}">X</button>
                </td>
            </tr>
        @endforeach
    @endsection
@endsection

@section('addItemSection')
    <!-- Button to trigger modal -->
    <button class="btn btn-primary" style="position: fixed; bottom: 20px; right: 20px;" data-toggle="modal" data-target="#addItemModal">
        Add Item
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal for adding items -->
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Form fields for adding an item -->
                    <form id="addItemForm" action="/add-item" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="itemName">Item Name</label>
                                    <input type="text" class="form-control" id="itemName" name="itemName" required>
                                    @error('itemName')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="specification">Specification</label>
                                    <input type="text" class="form-control" id="specification" name="specification">
                                    @error('specification')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="rmeQuantity">RME Quantity</label>
                                    <input type="number" class="form-control" id="rmeQuantity" name="rmeQuantity" required>
                                    @error('rmeQuantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gudang4Quantity">Gudang 4 Quantity</label>
                                    <input type="number" class="form-control" id="gudang4Quantity" name="gudang4Quantity" required>
                                    @error('gudang4Quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gudang12Quantity">Gudang 12 Quantity</label>
                                    <input type="number" class="form-control" id="gudang12Quantity" name="gudang12Quantity" required>
                                    @error('gudang12Quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <select class="form-control" id="stock" name="stock" required>
                                        <option value="1">In Stock</option>
                                        <option value="0">Out of Stock</option>
                                    </select>
                                    @error('stock')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="visible">Visible</label>
                                    <select class="form-control" id="visible" name="visible" required>
                                        <option value="1">Visible</option>
                                        <option value="0">Invisible</option>
                                    </select>
                                    @error('visible')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" class="form-control" id="barcode" name="barcode">
                                    @error('barcode')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('editItemSection')
<!-- Modal for editing item -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!-- Form for editing item (similar to add item form) -->
                <form id="editItemForm" action="/edit-item" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="itemName">Item Name</label>
                                    <input type="text" class="form-control" id="itemName" name="itemName" required>
                                    @error('itemName')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="specification">Specification</label>
                                    <input type="text" class="form-control" id="specification" name="specification">
                                    @error('specification')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="rmeQuantity">RME Quantity</label>
                                    <input type="number" class="form-control" id="rmeQuantity" name="rmeQuantity" required>
                                    @error('rmeQuantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gudang4Quantity">Gudang 4 Quantity</label>
                                    <input type="number" class="form-control" id="gudang4Quantity" name="gudang4Quantity" required>
                                    @error('gudang4Quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gudang12Quantity">Gudang 12 Quantity</label>
                                    <input type="number" class="form-control" id="gudang12Quantity" name="gudang12Quantity" required>
                                    @error('gudang12Quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <select class="form-control" id="stock" name="stock" required>
                                        <option value="1">In Stock</option>
                                        <option value="0">Out of Stock</option>
                                    </select>
                                    @error('stock')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="visible">Visible</label>
                                    <select class="form-control" id="visible" name="visible" required>
                                        <option value="1">Visible</option>
                                        <option value="0">Invisible</option>
                                    </select>
                                    @error('visible')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" class="form-control" id="barcode" name="barcode">
                                    @error('barcode')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" form="editItemForm" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('deleteItemSection')
<!-- Modal for delete confirmation -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteItemModalLabel">Delete Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <!-- form for deletion -->
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="confirmDelete">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
