<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{

    /**
     * @return View
     */
    public function create() : View
    {
        return view('crud_products', [
            'route'   => route('product.store'),
        ]);
    }

    /**
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProductStoreRequest $request) : RedirectResponse
    {
        $product = Product::create($request->validated());

        return redirect()->route('product.edit', $product);
    }


    public function edit(Product $product)
    {
        return view('crud_products', [
            'route'   => route('product.update', $product),
            'product' => $product
        ]);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
