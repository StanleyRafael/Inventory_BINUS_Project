<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class stockOpnameController extends Controller
{
    public function index()
    {
        return view('stock-opname', [
            'inventory' => item::all()
        ]);
    }

    public function updateQuantities(Request $request)
    {
        // Retrieve the itemIdArray from the request
        $itemIdArray = $request->input('itemIdArray');

        foreach ($itemIdArray as $itemId) {
            // Construct the item data key
            $itemDataKey = $itemId;

            if ($request->has($itemDataKey)) {
                $itemData = $request->input($itemDataKey);

                // Find the item by its ID
                $item = Item::find($itemId);

                if ($item) {
                    // Update item quantities
                    if (isset($itemData['rmeQuantity'])) {
                        $item->rmeQuantity = $itemData['rmeQuantity'];
                    }

                    if (isset($itemData['gudang4Quantity'])) {
                        $item->gudang4Quantity = $itemData['gudang4Quantity'];
                    }

                    if (isset($itemData['gudang12Quantity'])) {
                        $item->gudang12Quantity = $itemData['gudang12Quantity'];
                    }

                    $item->save();
                    Log::info("Item {$itemId} updated successfully");
                } else {
                    Log::info("Item not found for ID: {$itemId}");
                }
            } else {
                Log::warning("Data for item ID {$itemId} is missing in the request.");
            }
        }

        // Return a response
        return response()->json(['message' => 'Quantities updated successfully']);
    }


}
