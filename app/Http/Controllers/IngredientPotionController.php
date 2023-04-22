<?php

namespace App\Http\Controllers;

use App\Models\IngredientPotion;
use App\Http\Requests\IngredientPotionStoreRequest;
use App\Http\Requests\UpdateIngredientPotionRequest;

class IngredientPotionController extends Controller
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
     * @param  \App\Http\Requests\IngredientPotionStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngredientPotionStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IngredientPotion  $ingredientPotion
     * @return \Illuminate\Http\Response
     */
    public function show(IngredientPotion $ingredientPotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IngredientPotion  $ingredientPotion
     * @return \Illuminate\Http\Response
     */
    public function edit(IngredientPotion $ingredientPotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIngredientPotionRequest  $request
     * @param  \App\Models\IngredientPotion  $ingredientPotion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngredientPotionRequest $request, IngredientPotion $ingredientPotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IngredientPotion  $ingredientPotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(IngredientPotion $ingredientPotion)
    {
        //
    }
}
