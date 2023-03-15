<?php

namespace App\Http\Controllers;

use App\BrandPriceLinkProducts;
use App\Products;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequest;
use App\Brands;
use App\Categories;
use App\Http\Resources\Products as ProductsResource;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        $brands = Brands::all();
        $categories = Categories::all();
        return view('products.create', compact('brands', 'categories'));
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
        $request = $request->validated();
        $product = Products::create($request);
        $brands = gettype($request['brands']) == "string" ? json_decode($request['brands']) : $request['brands'];
        foreach ($brands as $brand) {
            print_r($brand['product_url']);
            BrandPriceLinkProducts::create([
                "products_id" => $product->id,
                "brands_id" => $brand['brands_id'],
                "product_url" => strval($brand['product_url']),
                "price" => $brand['price']
            ]);
        }
        
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
            return redirect('/products');
        }
        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }

    public function edit(Products $product)
    {
        $brands = Brands::all();
        $categories = Categories::all();
        return view('products.edit', compact('brands', 'categories'))->with('product', $product);
    }

    public function sendCsvProducts(Request $request)
    {
        $products = $this->csvToArray($request->file('file'));
        foreach ($products as $product) {
            $mountedProduct = $this->mountStructureProduct($product);
            if ($mountedProduct) Products::updateOrCreate(["product_url" => $mountedProduct['product_url']], $mountedProduct);
        }
        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }

    public function csvToArray($csvFile)
    {
        $file_to_read = fopen($csvFile, 'r');
        while (!feof($file_to_read) ) {
            $lines[] = fgetcsv($file_to_read, 1000, ',');
        }
        fclose($file_to_read);
        return $lines;
    }

    public function mountStructureProduct($product)
    {
        if (!$product || $product[0] == "CODIGO DO LINK") return false;
        $productMounted = [];
        $productMounted['name'] = $product[2];
        $productMounted['price'] = explode("R$", $product[4])[1];
        $productMounted['images_url'] = explode('" ></a><IMG', explode('IMG border=0 src="', $product[0])[1])[0];
        $productMounted['product_url'] = explode('"><', explode('<a href="', $product[0])[1])[0];
        $productMounted['description'] = $product[5];
        return $productMounted;
    }
}
