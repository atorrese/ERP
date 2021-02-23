<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    public function index()
    {
        return view('products.index',[
            'title'=>'Listado de Productos',
            'products'=>Product::query()->latest()->paginate(5)
        ]);
    }

    public function create()
    {
        return view('products.create',[
            'categories'=> Category::all()
        ]);
    }


    public function store(ProductStoreRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products.index');
    }


    public function show(Product $product)
    {
        return  view('products.show',[
            'products'=> $product
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit',[
            'product' =>  $product,
            'categories' =>Category::all()
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());

        return  redirect()->route('products.show',[
            'product' => $product
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
