<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Categories as CategoriesResource;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function show(Categories $category) {
        return new CategoriesResource($category);
    }

    public function getCategoriesJson() {
        return CategoriesResource::collection(Categories::all());
    }

    public function getCategories(Request $request)
    {
        $length = $request->input('length');
        $orderBy = $request->input('column'); //Index
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        
        $query = Categories::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function edit(Categories $category)
    {
        return view('categories.edit')->with('category', $category);
    }

    public function store(Request $request)
    {
        $request = $request->all();
        Categories::create($request);

        if (array_key_exists('redirect', $request) && $request['redirect']) {
            return redirect('/categories');
        }
        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }

    public function delete(Categories $category) {
        return $category->delete();
    }

    public function update(Categories $category)
    {
        $request = request()->all();
        $category->update($request);
        if (array_key_exists('redirect', $request) && $request['redirect']) {
            return redirect('/categories');
        }
        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }
}
