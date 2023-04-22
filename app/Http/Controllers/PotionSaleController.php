<?php

namespace App\Http\Controllers;

use App\Models\PotionSale;
use App\Http\Requests\PotionSaleStoreRequest;
use App\Http\Requests\PotionSaleUpdateRequest;

class PotionSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PotionSaleStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PotionSaleStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PotionSale  $potionSale
     * @return \Illuminate\Http\Response
     */
    public function show(PotionSale $potionSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PotionSale  $potionSale
     * @return \Illuminate\Http\Response
     */
    public function edit(PotionSale $potionSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PotionSaleUpdateRequest  $request
     * @param  \App\Models\PotionSale  $potionSale
     * @return \Illuminate\Http\Response
     */
    public function update(PotionSaleUpdateRequest $request, PotionSale $potionSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PotionSale  $potionSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(PotionSale $potionSale)
    {
        //
    }
}
