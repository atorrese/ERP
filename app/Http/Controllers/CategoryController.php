<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return view('categories.index',[
            'title'=>'Listado de Categorias',
            'categories'=>Category::query()->latest()->paginate(5)
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }


    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        return  view('categories.show',[
            'category'=>  $category
        ]);
    }

    public function edit(Category $category)
    {
        return view('categories.edit',[
            'category'=>  $category
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());

        return  redirect()->route('categories.show',[
            'category'=>$category
        ]);
    }

    public function destroy(Category $category)
    {
        if($category->products->count() == 0){
            $category->delete();
        }
        return redirect()->route('categories.index');
    }
}
