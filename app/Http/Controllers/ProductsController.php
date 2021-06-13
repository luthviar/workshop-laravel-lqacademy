<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use App\Models\ProductsCategories;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;

class ProductsController extends Controller
{
    //menampilkan semua produk
    public function index() {
        $products = Products::with('productCategories')->get();
        $datas = [
            'satu', 'dua'
        ];
        // cara 1
        return view('toko.home', compact(['products', 'datas']));

        // cara 2
        // return view('toko.home')
        //         ->with('products', $products)
        //         ->with('datas', $arrayData);
    }

    //menampilkan detil produk
    public function show($id) {
        $dataProduct = Products::with('productCategories')->where('id',$id)->first();
        return view('toko.products.detail')->with('product', $dataProduct);
    }

    //menampilkan halaman membuat produk
    public function create() {
        $categories = Categories::all();
        return view('toko.products.create', compact(['categories']));
    }

    //melakukan simpan produk baru
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'url_image' => 'required',
            'price' => 'required',
            'categories' => 'required',       
            'status' => 'required'
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $product = Products::create([
            'name' => $request->name,
            'description' => $request->description,
            'url_image' => $request->url_image,
            'price' => $request->price,
            'status' => $request->status,
            'created_by' => Auth::user()->id
        ]);

        foreach ($request->categories as $idCategory) {
            ProductsCategories::create([
                'products_id' => $product->id,
                'categories_id' => $idCategory
            ]);
        }        

        Session::flash('status_success', 'Data produk bernama: "' . $product->name .'" berhasil ditambahkan');
        return back();
    }

    //menampilkan halaman edit produk
    public function edit($id) {
        $product = Products::with('productCategories')->where('id', $id)->first();
        $categories = Categories::all();
        $idCategories = [];
        foreach ($product->productCategories as $data) {            
            $idCategories[] = $data->category->id;
        }        
        
        return view('toko.products.edit', compact(['product', 'categories', 'idCategories']));
    }

    //mengupdate data produk
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'url_image' => 'required',
            'price' => 'required',
            'categories' => 'required',       
            'status' => 'required'
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $product = Products::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->url_image = $request->url_image;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->created_by = Auth::user()->id;        
        $product->save();        

        ProductsCategories::where('products_id', $id)->delete();
        foreach ($request->categories as $idCategory) {
            ProductsCategories::create([
                'products_id' => $product->id,
                'categories_id' => $idCategory
            ]);
        }        

        Session::flash('status_success', 'Data produk bernama: "' . $product->name .'" berhasil di-edit.');
        return back();
    }

    //menghapus data produk
    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'products_id' => 'required|integer|min:1',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $id = $request->products_id;
        
        $product = Products::find($id);
        
        
        ProductsCategories::where('products_id', $id)->delete();
        //cara 1
        // Products::destroy($id);

        //cara 2        
        Products::where('id', $id)->delete();            

        Session::flash('status_success', 'Data produk bernama: "' . $product->name . '" berhasil dihapus.');
        return back();
    }
}
