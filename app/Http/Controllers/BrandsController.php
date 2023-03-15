<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brands;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use App\Http\Requests\BrandsRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Brands as BrandsResource;
use PhpOffice\PhpSpreadsheet\Calculation\brand;

class BrandsController extends Controller
{
    public function index()
    {
        return view('brands.index');
    }

    public function show(Brands $brand) {
        return new BrandsResource($brand);
    }

    public function getBrandsJson() {
        return BrandsResource::collection(Brands::all());
    }

    public function getBrands(Request $request)
    {
        $length = $request->input('length');
        $orderBy = $request->input('column'); //Index
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        
        $query = Brands::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }

    public function create()
    {
        return view('brands.create');
    }

    public function edit(Brands $brand)
    {
        return view('brands.edit')->with('brand', $brand);
    }

    public function store(Request $request)
    {
        $request = $request->all();
        Brands::create($request);

        if (array_key_exists('redirect', $request) && $request['redirect']) {
            return redirect('/brands');
        }
        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }

    public function delete(Brands $brand) {
        return $brand->delete();
    }

    public function update(Brands $brand)
    {
        $request = request()->all();
        $brand->update($request);
        if (array_key_exists('redirect', $request) && $request['redirect']) {
            return redirect('/brands');
        }
        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }
}
