<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Models\Customers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $customer = Customers::create($request->validated());

        return redirect()->route('customer.edit', $customer);
    }



    public function edit(Customers $customer): View
    {
        return view('crud_customers', [
            'route'   => route('customer.update', $customer),
            'customer' => $customer
        ]);
    }


    /**
     * @param UpdateRequest $request
     * @param Customers $customer
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Customers $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()->route('customer.edit', $customer);
    }


    public function destroy($id)
    {
        //
    }
}
