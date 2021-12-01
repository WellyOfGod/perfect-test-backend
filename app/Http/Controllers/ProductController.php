<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
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
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request) : RedirectResponse
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
     * @param UpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->route('product.edit', $product);
    }

}
