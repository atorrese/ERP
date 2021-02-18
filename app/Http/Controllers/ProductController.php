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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('products.index',[
            'title'=>'Listado de Productos',
            'products'=>Product::query()->latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('products.create',[
            'categories'=> Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductStoreRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        return  view('products.show',[
            'products'=> $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('products.edit',[
            'product' =>  $product,
            'categories' =>Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());

        return  redirect()->route('products.show',[
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
