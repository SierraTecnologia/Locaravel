<?php

namespace Locaravel\Http\Controllers\Admin;

use Locaravel\Models\Address;

class AddressController extends Controller
{
    public function index(Request $request): \Illuminate\View\View
    {
        $addresses = Address::sempai()->get();
        return view('locaravel::admin.addresses.index', compact('addresses'));
    }
    
    /**
     * Display the specified Page.
     *
     * @param string $date
     *
     * @return \Illuminate\View\View
     */
    public function show($id): \Illuminate\View\View
    {
        $address = Address::findOrFail($id);

        $addresses = Address::addressesByFather($id)->get();

        return view(
            'locaravel::admin.addresses.show',
            compact(
                'address',
                'addresses'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id = false): \Illuminate\View\View
    {
        Address::findOrFail($id);

        Address::addressesByFather($id)->get();

        return view('locaravel::admin.addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        Address::create(['name' => $request->name]);

        return redirect('addresses');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, $id): \Illuminate\View\View
    {
        $address = Address::findOrFail($id);

        return view('locaravel::admin.addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $address = Address::findOrFail($request->address_id);

        $address->name = $request->name;

        $address->update();

        return redirect('addresses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $address = Address::findOrFail($id);

        $address->delete();

        return redirect('addresses');
    }
}
