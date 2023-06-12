<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
        public function index()
    {
        // $product = Product::with('productdetails')->find($id);
        // return response()->json($product);
        return Product::all();
    }

    
    public function create()
    {
        return Inertia::render('Product/ProductAdd');
    }

        public function show($id)
    {
        $product = Product::with('productdetails')->find($id);

        return response()->json($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'amount'=>'required',
            'price'=>'required',
        ]);

        try{
            Product::create($request->post());

            return response()->json([
                'message'=>'Product Created Successfully!!'
            ]);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while creating a Product!!'
            ],500);
        }
    }
}
