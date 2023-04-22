<?php

namespace App\Http\Controllers;

use App\Models\Potion;
use App\Helpers\ApiResponser;
use App\Http\Requests\PotionRequest;
use App\Http\Resources\PotionResource;
use App\Http\Requests\PotionStoreRequest;
use App\Http\Requests\PotionUpdateRequest;
use App\Models\Ingredient;

class PotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PotionRequest $request)
    {
        $limit   = $request->limit ? $request->limit : 12;
        $page    = $request->page ? $request->page : 1;
        $potions = Potion::list($limit, $page)->with('ingredients')->get()->mapInto(PotionResource::class);
        return $this->success($potions);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PotionStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PotionStoreRequest $request)
    {
        $data = $request->all();

        $potion      = Potion::create($data);
        $potionTotal = 0;
        if (isset($data['ingredients']) && $data['ingredients']) {
            $potion->ingredients()->sync($data['ingredients']);
            $potionTotal = 0;
            foreach ($potion->ingredients as $ingredient) {
                $potionTotal += $ingredient->pivot->quantity * $ingredient->price;
            }
            $potion->price = round($potionTotal);
            $potion->save();
        }

        $potion->load('ingredients');


        return $this->success(PotionResource::make($potion), 'Poción creada con éxito.', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Potion  $potion
     * @return \Illuminate\Http\Response
     */
    public function show(Potion $potion)
    {
        $potion->load('ingredients');
        return $this->success(PotionResource::make($potion));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PotionUpdateRequest  $request
     * @param  \App\Models\Potion  $potion
     * @return \Illuminate\Http\Response
     */
    public function update(PotionUpdateRequest $request, Potion $potion)
    {
        $data = $request->all();
        $potion->fill($data);
        if ($potion->isDirty()) {
            $potion->save();
        }

        if (isset($data['ingredients']) && $data['ingredients']) {
            $potion->ingredients()->detach();
            $potion->ingredients()->sync($data['ingredients']);
        }
        $potion->load('ingredients');
        return $this->success(PotionResource::make($potion), 'Poción actualizada con éxito.', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Potion  $potion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Potion $potion)
    {
        $potion->delete();
        return $this->success([], 'Poción eliminada con éxito.', 202);
    }
}
