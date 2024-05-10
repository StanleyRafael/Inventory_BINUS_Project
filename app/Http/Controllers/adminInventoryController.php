<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\item;
use App\Exports\InventoryExport;

class adminInventoryController extends Controller
{
    public function index()
    {
        return view('adminInventory', [
            'inventory' => item::all()
        ]);
    }

    // Method to add a new item to the inventory
    public function addItem(Request $request)
    {
        $validatedData = $request->validate([
            'itemName' => 'required|string|max:48',
            'specification' => 'nullable|string|max:48',
            'rmeQuantity' => 'required|integer|min:0',
            'gudang4Quantity' => 'required|integer|min:0',
            'gudang12Quantity' => 'required|integer|min:0',
            'description' => 'nullable|string|max:100',
            'stock' => 'required|boolean',
            'visible' => 'required|boolean',
            'barcode' => 'nullable|string|max:100',
        ]);

        $item = new Item();
        $item->itemName = $validatedData['itemName'];
        $item->specification = $validatedData['specification'];
        $item->rmeQuantity = $validatedData['rmeQuantity'];
        $item->gudang4Quantity = $validatedData['gudang4Quantity'];
        $item->gudang12Quantity = $validatedData['gudang12Quantity'];
        $item->description = $validatedData['description'];
        $item->stock = $validatedData['stock'];
        $item->visible = $validatedData['visible'];
        $item->barcode = $validatedData['barcode'];
        $item->save();

        return redirect()->back();
    }

    public function getItem($itemId)
    {
        $item = Item::findOrFail($itemId);
        return response()->json($item);
    }

    public function editItem(Request $request, $itemId)
    {
        $validatedData = $request->validate([
            'itemName' => 'required|string|max:48',
            'specification' => 'nullable|string|max:48',
            'rmeQuantity' => 'required|integer|min:0',
            'gudang4Quantity' => 'required|integer|min:0',
            'gudang12Quantity' => 'required|integer|min:0',
            'description' => 'nullable|string|max:100',
            'stock' => 'required|boolean',
            'visible' => 'required|boolean',
            'barcode' => 'nullable|string|max:100',
        ]);

        $item = Item::findOrFail($itemId);
        $item->itemName = $validatedData['itemName'];
        $item->specification = $validatedData['specification'];
        $item->rmeQuantity = $validatedData['rmeQuantity'];
        $item->gudang4Quantity = $validatedData['gudang4Quantity'];
        $item->gudang12Quantity = $validatedData['gudang12Quantity'];
        $item->description = $validatedData['description'];
        $item->stock = $validatedData['stock'];
        $item->visible = $validatedData['visible'];
        $item->barcode = $validatedData['barcode'];
        $item->save();

        return redirect()->back();
    }


    public function deleteItem(Request $request, $itemId)
    {
        // Find the item by its ID and delete it
        Item::destroy($itemId);

        // Redirect to the previous page with a success message
        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    public function exportInventory()
    {
        $inventory = Item::orderBy('itemName')->get(); // Fetch inventory data

        $export = new InventoryExport($inventory);
        $export->export();

        return response()->download('inventory.xlsx')->deleteFileAfterSend(true);
    }

}
