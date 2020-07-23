<?php

namespace Locaravel\Http\Controllers;

use Locaravel\Models\Address;

class AddressController extends Controller
{


    public function index()
    {
        $addresses = Address::sempai()->get();
        return view('locaravel::addresses.index',  compact('addresses'));
    }
    
    /**
     * Display the specified Page.
     *
     * @param string $date
     *
     * @return Response
     */
    public function show($id)
    {
        $address = Address::findOrFail($id);

        $addresses = Address::addressesByFather($id)->get();

        return view(
            'locaravel::addresses.show',
            compact(
                'address',
                'addresses'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = false)
    {
        $address = Address::findOrFail($id);

        $addresses = Address::addressesByFather($id)->get();

        return view('locaravel::addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::findOrFail($id);

        return view('locaravel::addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);

        $address->delete();

        return redirect('addresses');
    }
}