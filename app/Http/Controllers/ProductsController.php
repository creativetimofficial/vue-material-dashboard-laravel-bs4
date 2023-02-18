<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequest;
use App\Http\Resources\Products as ProductsResource;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function show(Products $product) {
        return new ProductsResource($product);
    }

    public function getProductsJson() {
        return ProductsResource::collection(Products::all());
    }

    public function getProducts(Request $request)
    {
        $length = $request->input('length');
        $orderBy = $request->input('column'); //Index
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        
        $query = Products::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }

    /**
     * Store a new product.
     *
     * @param  \App\Http\Requests\ProductsRequest $request
     */
    public function store(ProductsRequest $request)
    {
        Products::create($request->validated());
        $request = $request->all();
        if (array_key_exists('redirect', $request) && $request['redirect']) {
            return redirect('/products');
        }
        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }

    public function delete(Products $product) {
        return $product->delete();
    }

    public function update(Products $product)
    {
        $request = request()->all();
        $product->update($request);
        if (array_key_exists('redirect', $request) && $request['redirect']) {
            return redirect('/categories');
        }
        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }

    public function edit(Products $product)
    {
        return view('products.edit')->with('product', $product);
    }
}
