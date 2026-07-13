<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
class CartController extends Controller { public function index(){return view('cart',['items'=>$this->items()]);} public function add(Product $product):RedirectResponse{$cart=session('cart',[]);$cart[$product->id]=($cart[$product->id]??0)+1;session(['cart'=>$cart]);return redirect()->route('cart')->with('success',__('ui.added'));} public function remove(Product $product):RedirectResponse{$cart=session('cart',[]);unset($cart[$product->id]);session(['cart'=>$cart]);return back();} private function items(){$cart=session('cart',[]);return Product::whereIn('id',array_keys($cart))->get()->map(fn($p)=>['product'=>$p,'quantity'=>(int)$cart[$p->id],'line_total'=>(float)$p->price*(int)$cart[$p->id]]);} }
