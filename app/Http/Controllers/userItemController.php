<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NormalUser;
use App\Models\item;
use App\Models\Log as userLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;




class userItemController extends Controller
{
    public function addItemView()
    {
        return view('userAddItem', [
            'inventory' => item::all()
        ]);
    }

    public function addItem(Request $request)
    {
        $validatedData = $request->validate([
            'warehouse' => 'required|string|in:R.ME,Gudang 4,Gudang 12',
            'itemQuantity' => 'required|integer|min:0',
        ]);

        $item = item::findOrFail($request->itemId);

        switch ($validatedData['warehouse']) {
            case 'R.ME':
                $item->rmeQuantity += $validatedData['itemQuantity'];
                break;
            case 'Gudang 4':
                $item->gudang4Quantity += $validatedData['itemQuantity'];
                break;
            case 'Gudang 12':
                $item->gudang12Quantity += $validatedData['itemQuantity'];
                break;
        }

        $item->save();
        return redirect()->back();
    }

    public function takeItemView()
    {
        return view('userTakeItem', [
            'inventory' => item::all()
        ]);
    }

    public function takeItem(Request $request)
    {
        $validatedData = $request->validate([
            'warehouse' => 'required|string|in:R.ME,Gudang 4,Gudang 12',
            'itemQuantity' => 'required|integer|min:0',
        ]);

        $item = item::findOrFail($request->itemId);

        switch ($validatedData['warehouse']) {
            case 'R.ME':
                $item->rmeQuantity -= $validatedData['itemQuantity'];
                break;
            case 'Gudang 4':
                $item->gudang4Quantity -= $validatedData['itemQuantity'];
                break;
            case 'Gudang 12':
                $item->gudang12Quantity -= $validatedData['itemQuantity'];
                break;
        }

        $item->save();
        return redirect()->back();
    }

    public function updateQuantities(Request $request)
    {
        // Retrieve the itemIdArray from the request
        $itemIdArray = $request->input('itemIdArray');

        // Loop through each item ID and its corresponding data
        foreach ($itemIdArray as $index => $itemId) {
            // Find the item by its ID
            $item = Item::find($itemId);

            if ($item) {
                // Extract data for the specific item ID
                $itemKey = "itemId_" . ($index + 1);

                if (isset($request[$itemKey])) {
                    $itemData = $request[$itemKey];

                    // Calculate the total requested change in quantities
                    $totalRmeChange = $itemData['rmeQuantity'] ?? 0;
                    $totalGudang4Change = $itemData['gudang4Quantity'] ?? 0;
                    $totalGudang12Change = $itemData['gudang12Quantity'] ?? 0;

                    // Check if the new quantities would be negative
                    if (($item->rmeQuantity + $totalRmeChange) < 0 ||
                        ($item->gudang4Quantity + $totalGudang4Change) < 0 ||
                        ($item->gudang12Quantity + $totalGudang12Change) < 0) {
                        // Return an error response immediately
                        return response()->json(['error' => "Item $item->itemName: Quantity cannot exceed the available quantity in the database."], 400);
                    }

                    // Check the quantities exist
                    if (isset($itemData['rmeQuantity'])) {
                        $item->rmeQuantity += $itemData['rmeQuantity'];
                    }

                    if (isset($itemData['gudang4Quantity'])) {
                        $item->gudang4Quantity += $itemData['gudang4Quantity'];
                    }

                    if (isset($itemData['gudang12Quantity'])) {
                        $item->gudang12Quantity += $itemData['gudang12Quantity'];
                    }

                    $item->save();

                    $userLog = new UserLog();
                    $userLog->user_id = auth()->id(); // Get the currently authenticated user's ID
                    if ($userLog->user_id === null) {
                        // Handle the case where auth()->id() returns null
                        Log::error("Failed to obtain user ID for log entry.");
                        return response()->json(['error' => 'Failed to obtain user ID.'], 500);
                    }
                    $userLog->itemName = $item->itemName;
                    $userLog->rmeQuantity = $itemData['rmeQuantity'];
                    $userLog->gudang4Quantity = $itemData['gudang4Quantity'];
                    $userLog->gudang12Quantity = $itemData['gudang12Quantity'];
                    $userLog->reason = $itemData['reason'] ?? '';
                    $userLog->save();

                } else {
                    Log::warning("Data for item ID {$itemId} is missing in the request.");
                }
            } else {
                Log::info("Item not found for ID: {$itemId}");
            }
        }

        // Return a response
        return response()->json(['message' => 'Quantities updated successfully']);
    }

    // public function viewLogs()
    // {
    //     return view('userLogs');
    // }

    public function showLogs(Request $request)
    {
        // Get the ID of the currently authenticated user
        $userId = Auth::guard('user')->id();

        // Get the selected month from the request
        $selectedMonth = $request->query('month');

        // Query logs based on the current user's ID and the selected month
        $query = userLog::where('user_id', $userId);

        if ($selectedMonth) {
            // Filter logs by the selected month if provided
            $query->whereMonth('created_at', $selectedMonth);
        }

        // Get the logs and order them by creation date in descending order
        $logs = $query->orderBy('created_at', 'desc')->get();

        // Return the view with the filtered logs
        return view('userLogs', ['logs' => $logs]);
    }

}
