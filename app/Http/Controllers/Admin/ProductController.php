<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function addCategory(Request $request)
    {
        try {
            DB::beginTransaction();
            $category = new ProductCategory();
            $category->id = (string) Str::uuid();
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'type' => $category
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = ProductCategory::with('products')->get();
            return view('pages.admin.product.index', compact('categories'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */ public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:product_categories,id',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'status' => 'required', 
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            DB::beginTransaction();

            $product = new Product();
            $product->category_id = $request->category_id;
            $product->title = $request->title;
            $product->slug = Str::slug($request->title);
            $product->content = $request->content;
            $product->publish_date = now();
            $product->status = $request->status;

            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $image->storeAs('product', $image->hashName(), 'public');
                $product->thumbnail = $image->hashName();
            }

            $product->save();
            DB::commit();

            return back()->with('success', 'Product created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Failed to create product: ' . $th->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:product_categories,id',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'status' => 'required',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $product->category_id = $request->category_id;
            $product->title = $request->title;
            $product->slug = Str::slug($request->title);
            $product->content = $request->content;
            $product->status = $request->status;

            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($product->thumbnail) {
                    unlink(storage_path('app/public/product/' . $product->thumbnail));
                }
                
                $image = $request->file('thumbnail');
                $image->storeAs('product', $image->hashName(), 'public');
                $product->thumbnail = $image->hashName();
            }

            $product->save();
            DB::commit();

            return response()->json([
                'success' => true,
                'product' => $product,
                'message' => 'Product updated successfully'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // return back()->with('error', 'Failed to update product: ' . $th->getMessage());
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            DB::beginTransaction();
            
            if ($product->thumbnail) {
                unlink(storage_path('app/public/product/' . $product->thumbnail));
            }
            
            $product->delete();
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['success' => false]);
        }
    }
}
