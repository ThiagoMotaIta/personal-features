<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function index(){

        // Fullfill the selects
        $clients = User::where('type','C')->get();
        $sailers = User::where('type','V')->get();
        $products = Product::get();

        return view('pages.admin-home', compact('clients','sailers','products'));
    }
}
