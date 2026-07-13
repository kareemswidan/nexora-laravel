<?php
namespace App\Http\Controllers;
use App\Models\Product;
class StoreController extends Controller { public function home(){return view('home',['products'=>Product::where('is_active',true)->take(6)->get()]);} public function shop(){return view('shop',['products'=>Product::where('is_active',true)->get()]);} public function product(Product $product){abort_unless($product->is_active,404);return view('product',compact('product'));} }

