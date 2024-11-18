<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    if (auth()->user()->userType == 1) {
        // Super Admin: Show all products with creator's full name
        $products = Product::with('creator')->get();
    } else {
        // Normal User: Show only their own products
        $products = Product::with('creator')->where('createdBy', auth()->id())->get();
    }

    return view('products.index', compact('products'));
}
public function create()
{
    return view('products.create');  
}

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;

    if ($request->hasFile('image')) {
        $filePath = $request->file('image')->store('products', 'public');
        $product->image = $filePath;
    }

    $product->createdBy = auth()->id();
    $product->save();

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }


    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Validate the input
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update product fields
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;

    // Handle the image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }

        // Store the new image
        $filePath = $request->file('image')->store('products', 'public');
        $product->image = $filePath;
    }

    // Save the updated product
    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}
