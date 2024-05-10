<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\item;
use Illuminate\Http\Request;

class viewInventoryController extends Controller
{
    public function index()
    {
        // $item1 = new item();
        // $item1->itemName = "Paku";
        // $item1->itemQuantity = 125;
        // $item1->save();

        /* Other method to insert:
            $item1 = new item([
                'itemName' => "Paku",
                'itemQuantity' => 125,
            ]);

        But remember to insert a fillable property to the item model:
            protected $fillable = [
                'itemName',
                'itemQuantity',
            ];
        */

        return view('inventory', [
            'inventory' => item::all()
        ]);
    }
}
