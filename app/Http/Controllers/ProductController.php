<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function order(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
            'comment' => 'nullable|string|max:500',
        ]);

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

        // Уменьшаем количество на складе
        $product->decrement('stock', $request->quantity);

        return redirect()->route('products.index')->with('success', 'Заявка успешно создана!');
    }
}