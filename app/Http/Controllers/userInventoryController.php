<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\item;


class userInventoryController extends Controller
{
    public function index()
    {
        return view('userInventory', [
            'inventory' => item::all()
        ]);
    }
}
