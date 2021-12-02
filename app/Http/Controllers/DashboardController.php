<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\FilterRequest;
use App\Models\{Customer, Product, Sale, SaleSituation};
use DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Dashboard index
     *
     * @return View
     */
    public function __invoke(FilterRequest $request): View
    {
        return view('dashboard', $this->filterData($request));
    }

    /**
     * Filter dashboard data
     *
     * @param FilterRequest $request
     * @return View
     */
    public function filterData(FilterRequest $request): array
    {
        $validated = $request->validated();

        $sales = Sale::query()
            ->select('sold_at', 'product_id', 'customer_id', 'discount', 'total', 'id')
            ->when($validated->sale_date_range, fn ($q) =>
                $q->whereBetween('sold_at', [$validated->initial_date, $validated->final_date])
            )->when($validated->customer, fn ($q) =>
                $q->where('customer_id', $validated->customer))
            ->with([
                'product:id,name,price',
                'customer:id,name'
            ])
            ->paginate(10);

        $saleResults = SaleSituation::query()
            ->select(DB::raw('COUNT(sales.id) as sales_count, SUM(sales.total) as sales_total'), 'name')
            ->join('sales', 'sales.sale_situation_id', 'sale_situations.id')
            ->groupBy('name')
            ->get();

        return [
            'saleResults'          => $saleResults,
            'currentCustomer'      => $validated->customer,
            'currentSaleDateRange' => $validated->sale_date_range,
            'sales'                => $sales,
            'customers'            => Customer::all(['name', 'cpf', 'id']),
            'products'             => Product::paginate(10)
        ];
    }
}
