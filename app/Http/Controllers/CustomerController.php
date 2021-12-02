<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class CustomerController extends Controller
{

    /**
     * @return View
     */
    public function create(): View
    {
        return view('crud_customers', [
            'route'   => route('customer.store'),
        ]);
    }


    /**
     * @param CustomerStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        $customer = Customer::create($request->validated());

        return redirect()->route('customer.edit', $customer);
    }


    /**
     * @param Customer $customer
     * @return View
     */
    public function edit(Customer $customer): View
    {
        return view('crud_customers', [
            'route'   => route('customer.update', $customer),
            'customer' => $customer
        ]);
    }


    /**
     * @param CustomerUpdateRequest $request
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function update(CustomerUpdateRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()->route('customer.edit', $customer);
    }


    /**
     * @param Customer $customer
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customer.create');
    }
}
