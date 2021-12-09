<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sale\SaleRequest;
use App\Models\{Customer, Product, Sale, SaleSituation};
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Fluent;
use Illuminate\View\View;

class SaleController extends Controller
{
    private function viewParams(string $route, $sale): array
    {
        return [
            'route'          => $route,
            'customers'      => Customer::all(['id', 'cpf', 'name']),
            'products'       => Product::all(['id', 'price', 'name']),
            'saleSituations' => SaleSituation::all(['name', 'id']),
            'sale'           => $sale
        ];
    }

    public function create(): View
    {
        $sale = new Fluent();
        $sale->customer = new Fluent();

        return view('crud_sales', $this->viewParams(route('sale.store'), $sale));
    }

    public function store(SaleRequest $request): RedirectResponse
    {
        $data = new Fluent($request->validated());

        if (!$request->customer_id) {
            $customer = Customer::create($data->toArray());
            $data->customer_id = $customer->id;
        }

        $value = Product::select('id', 'price')
                ->where('id', $data->product_id)
                ->first()
                ->price * $data->quantity;

        $data->total = $data->discount
            ? $value - ($value * ($data->discount / 100))
            : $value;

        $sale = Sale::create($data->toArray());

        return redirect()->route('dashboard', $sale);

    }

    public function edit(Sale $sale): View
    {
        return view('crud_sales', $this->viewParams(route('sale.update', $sale), $sale));
    }

    public function update(SaleRequest $request, Sale $sale): RedirectResponse
    {
        $data = new Fluent($request->validated());
        $sale->load('product');

        $price = $sale->product->id === $data->product_id
            ? $sale->product->price
            : Product::select('id', 'price')
                ->where('id', $data->product_id)
                ->first()
                ->price;

        $value = $price * $data->quantity;

        $data->total = $data->discount
            ? $value - ($value * ($data->discount / 100))
            : $value;

        $sale->update($data->toArray());

        return redirect()->route('dashboard', $sale);
    }
}
