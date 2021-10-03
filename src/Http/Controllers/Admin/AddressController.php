<?php

namespace Locaravel\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Locaravel\Models\Address;

class AddressController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $addresses = Address::sempai()->get();
        return view('locaravel::admin.addresses.index', compact('addresses'));
    }
    
    /**
     * Display the specified Page.
     *
     * @param string $date
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id = false)
    {
        $address = Address::findOrFail($id);

        $addresses = Address::addressesByFather($id)->get();

        return view('locaravel::admin.addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Address::create(['name' => $request->name]);

        return redirect('addresses');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        return view('locaravel::admin.addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        $address->delete();

        return redirect('addresses');
    }
}
