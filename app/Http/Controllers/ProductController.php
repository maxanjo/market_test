<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index(ProductRequest $request){
    
        $filters = $request->validated();

        $products = Product::filter($filters)->paginate(15);

        $products->appends($filters);

        return ProductResource::collection($products);
    }
}
