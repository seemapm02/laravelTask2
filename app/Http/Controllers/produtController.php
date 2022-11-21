<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Validator;


class produtController extends Controller
{
    protected $user;

    public function __construct()
    {
        return $this->middleware('auth:api');
    }

    public function displayProduct(Request $request)
    {
        //$product = $this->user->product()->get();
    }

    public function createProduct(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string',
           // 'price'=>'required|float'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>false,'error'=>$validator->errors()],400); 
        }

        $product = new product;

        $product->name = $request->name;
        $product->price = $request->price;

        if($this->user->product()->save($product))
        {
            return response()->json(
                ['status'=>true,'products'=>$product]);
        }
    }

    public function updateProduct(Request $request)
    {

    }


}
