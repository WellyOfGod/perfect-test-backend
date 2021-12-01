<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
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
     * @param ProductUpdateRequest $request
     * @return RedirectResponse
     */
    public function store(ProductUpdateRequest $request) : RedirectResponse
    {
        $product = Product::create($request->validated());

        return redirect()->route('product.edit', $product);
    }

    /**
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        return view('crud_products', [
            'route'   => route('product.update', $product),
            'product' => $product
        ]);
    }


    /**
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->route('product.edit', $product);
    }

}
