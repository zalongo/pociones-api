<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Potion;
use App\Services\SaleService;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;

class SaleController extends Controller
{
    private $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\SaleRequest
     */
    public function index(SaleRequest $request)
    {
        $limit     = $request->limit ? $request->limit : 12;
        $page      = $request->page ? $request->page : 1;
        $client_id = $request->has('client') ? $request->query('client') : null;

        $sales = Sale::list($limit, $page)->with('potions', 'client')
            ->when($client_id, function ($q) use ($client_id) {
                return $q->where('client_id', $client_id);
            })

            ->get()
            ->mapInto(SaleResource::class);

        return $this->success($sales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SaleStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleStoreRequest $request)
    {
        $data = $request->all();

        $saleTotal      = 0;
        $potionsforSale = [];
        foreach ($data['potions'] as $potion) {
            $thisPotion  = Potion::select('price')->find($potion['potion_id']);
            $totalPotion = $potion['quantity'] * $thisPotion->price;
            $potionsforSale[]            = [
                'potion_id' => $potion['potion_id'],
                'quantity'  => $potion['quantity'],
                'total'     => $totalPotion
            ];
            $saleTotal = $saleTotal + $totalPotion;

            foreach ($thisPotion->ingredients as $ingredient) {
                $ingredient->stock = $ingredient->stock - ($ingredient->pivot->quantity * $potion['quantity']);
                $ingredient->save();
            }
        }

        $sale = Sale::create([
            'client_id' => $data['client_id'],
            'total'     => $saleTotal,
        ]);

        $sale->potions()->sync($potionsforSale);
        $sale->load('potions', 'client');

        return $this->success(SaleResource::make($sale), 'Venta creada con éxito.', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $sale->load('client', 'potions');
        return $this->success(SaleResource::make($sale));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleRequest  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleUpdateRequest $request, Sale $sale)
    {

        $data = $request->all();


        if (isset($data['potions']) && count($data['potions'])) {
            $saleTotal      = 0;
            $potionsforSale = [];
            foreach ($data['potions'] as $potion) {
                $thisPotion  = Potion::select('price')->with('ingredients')->find($potion['potion_id']);
                $totalPotion = $potion['quantity'] * $thisPotion->price;
                $potionsforSale[] = [
                    'potion_id' => $potion['potion_id'],
                    'quantity'  => $potion['quantity'],
                    'total'     => $totalPotion
                ];
                $saleTotal = $saleTotal + $totalPotion;

                foreach ($thisPotion->ingredients as $ingredient) {
                    $ingredient->stock = $ingredient->stock - ($ingredient->pivot->quantity * $potion['quantity']);
                    $ingredient->save();
                }
            }
            $sale->potions()->sync($potionsforSale);
        }

        $sale->fill([
            'client_id' => $data['client_id'],
            'total'     => isset($saleTotal) ? $saleTotal : $sale->total,
        ]);

        if ($sale->isDirty()) {
            $sale->save();
        }

        // if (isset($data['potions']) && count($data['potions'])) {
        // }

        // $sale = Sale::with('potions', 'client')->find($sale->id);
        $sale->load('potions', 'client');

        return $this->success(SaleResource::make($sale), 'Venta actualizada con éxito.', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return $this->success([], 'Venta eliminada con éxito.', 202);
    }
}
