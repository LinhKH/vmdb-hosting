<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\ProductService;

class ProductController extends Controller
{
    private $productService;

    public function __construct(
        ProductService $productService
    ) {
        $this->productService = $productService;
    }


    public function index(Request $request)
    {
        $productLists = $this->productService->getProductList(collect($request->all()));
        return $productLists;
    }

    public function detail(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ], [], ['id' => __('label.t_product.id')]);
        $productDetail = $this->productService->findById($request->id);
        return $productDetail;
    }
}
