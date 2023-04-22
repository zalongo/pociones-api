<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Helpers\ApiResponser;
use App\Http\Resources\IngredientResource;
use App\Http\Requests\IngredientRequest;
use App\Http\Requests\IngredientStoreRequest;
use App\Http\Requests\IngredientUpdateRequest;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IngredientRequest $request)
    {
        $limit       = $request->limit ? $request->limit : 12;
        $page        = $request->page ? $request->page : 1;
        $ingredients = Ingredient::list($limit, $page)
            ->get()
            ->mapInto(IngredientResource::class);
        return $this->success($ingredients);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\IngredientStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngredientStoreRequest $request)
    {
        $ingredient = Ingredient::create($request->all());

        return $this->success(IngredientResource::make($ingredient), 'Ingrediente creado con éxito.', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        return $this->success(IngredientResource::make($ingredient));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\IngredientUpdateRequest  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(IngredientUpdateRequest $request, Ingredient $ingredient)
    {
        $ingredient->fill($request->all());
        if ($ingredient->isDirty()) {
            $ingredient->save();
        }
        return $this->success(IngredientResource::make($ingredient), 'Ingrediente actualizado con éxito.', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return $this->success([], 'Ingrediente eliminado con éxito.', 202);
    }
}
