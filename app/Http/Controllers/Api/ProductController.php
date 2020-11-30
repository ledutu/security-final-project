<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'find']]);
    }

    public function index(){
        $products = Product::all();
        
        return $this->response(200, ['products' => $products]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'product_name' => 'nullable|max:255',
            'product_price' => 'nullable',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $value) {
                return $this->response(200, [], $value, $validator->errors(), [], false);
            }
        }

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->save();

        return $this->response(200, [], 'Add successful');

    }

    public function find($id){
        $product = Product::find($id);

        return $this->response(200, ['product' => $product]);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'product_name' => 'nullable|max:255',
            'product_price' => 'nullable',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $value) {
                return $this->response(200, [], $value, $validator->errors(), [], false);
            }
        }

        $product = Product::where('product_id', (int)$request->product_id)->first();
        if(!$product) return $this->response(200, [], 'No product found', [], false);

        $product->product_name = $request->product_name;
        $product->product_price = (double)$request->product_price;
        $product->save();

        return $this->response(200, [], 'Update successful');
    }

    public function delete($id){
        $product = Product::find($id);

        if(!$product) return $this->response(200, [], 'No product found', [], false);

        $product->delete();

        return $this->response(200, [], 'Delete successful');
    }
}
