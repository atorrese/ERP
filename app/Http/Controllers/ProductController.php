<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        $title  ='Listado de Productos';
        return view('products.index',compact('title','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        return view('products.create',compact('categories','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => ['required','unique:products,name'],
            'description'=>'required',
            'price'=>'required',
            'cost'=>'required',
            'stock'=>'required',
        ],[
            'name.required' => 'El Campo es Obligatorio',
            'name.unique' => 'El campo debe ser unico',
            'description.required' => 'El Campo es Obligatorio',
            'price.required' => 'El Campo es Obligatorio',
            'cost.required' => 'El Campo es Obligatorio',
            'stock.required' => 'El Campo es Obligatorio',
            ]);
        Product::create([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'price'=>$data['price'],
            'cost'=>$data['cost'],
            'stock'=>$data['stock'],
            'category_id'=>$data['category_id'],
        ]);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return  view('products.show',compact('product'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories= Category::all();
        return view('products.edit',['product'=>  $product,'categories'=>$categories]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'=>[
                'required',
                Rule::unique('products')->ignore($product->id)],
                'description'=>'required',
                'price'=>'required',
                'cost'=>'required',
                'stock'=>'required',
                'category_id'=>''
            ],[
                'name.required' => 'El Campo es Obligatorio',
                'name.unique' => 'El campo debe ser unico',
                'description.required' => 'El Campo es Obligatorio',
                'price.required' => 'El Campo es Obligatorio',
                'cost.required' => 'El Campo es Obligatorio',
                'stock.required' => 'El Campo es Obligatorio',
                ]);
        //dd($data);
        $product->update($data);
        return  redirect()->route('products.show',['product'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
