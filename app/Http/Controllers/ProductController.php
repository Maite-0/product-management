<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
           // Get search query
    $search = $request->get('search');

    // Filter products based on the search query, if available
    $products = Product::latest()
    ->where('created_by', Auth::id()) // Filter by the logged-in user's ID
    ->when($search, function ($query) use ($search) {
        return $query->where('title', 'like', '%' . $search . '%')
                     ->orWhere('description', 'like', '%' . $search . '%')
                     ->orWhere('category', 'like', '%' . $search . '%');
    })
    ->paginate(perPage: 6); // Paginate the results
        return view("products.index",['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getProductDetails($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'category' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku',
            'status' => 'required|in:active,inactive',
            'owner_email' => 'required|email',
            'owner_mobilenumber' => 'required|string|max:20',
        ]);
    
        // Create the product with the validated data
        $product = Product::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image_url' => $validated['image_url'],
            'category' => $validated['category'],
            'sku' => $validated['sku'],
            'status' => $validated['status'],
            'owner_email' => $validated['owner_email'],
            'owner_mobilenumber' => $validated['owner_mobilenumber'],
            'created_by' => Auth::id(),  // Get the logged-in user's ID
            'updated_by' => Auth::id(),  // Get the logged-in user's ID
        ]);
    
        // Redirect back to the products list with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        // Retrieve the product data
        $product = Product::findOrFail($id);
    
        // Return the edit view with the product data
        return view('products.edit', compact('product'));
    }
    
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'owner_email' => 'required|email',
            'owner_mobilenumber' => 'required|string|min:10|max:11',
        ]);
    
        // Find the product and update with validated data
        $product = Product::findOrFail($id);
        $product->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category' => $validated['category'],
            'owner_email' => $validated['owner_email'],
            'owner_mobilenumber' => $validated['owner_mobilenumber'],
            'updated_by' => Auth::id(),  // Update the user who made the changes
        ]);
    
        // Redirect back to the product list with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
public function destroy(Product $product)
{
    if ($product) {
        // Delete the product
        $product->delete();

        // Redirect back to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    return redirect()->route('products.index')->with('error', 'Product not found!');
}
}
