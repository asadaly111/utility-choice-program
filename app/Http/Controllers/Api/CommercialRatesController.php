<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CommercialRate;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommercialRate\Store;
use App\Http\Requests\CommercialRate\Update;
use App\Http\Resources\CommercialRateResource;

class CommercialRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get all commercial rates in resource collection
        $commercialRates = CommercialRate::query()
        ->applyFilters($request)
            ->when($request->perPage, function ($query, $perPage) {
                return $query->orderByDesc('id')->paginate($perPage);
            }, function ($query) {
                return $query->orderByDesc('id')->get();
            });
        return CommercialRateResource::collection($commercialRates);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $customer = CommercialRate::create($request->validated());

        return response()->json([
            'message' => 'Commercial Rate successfully created.',
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
        return new CommercialRateResource(CommercialRate::findOrFail($id));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        $commercialRate = CommercialRate::findOrFail($id);
        $commercialRate->update($request->validated());

        return response()->json([
            'message' => 'Commercial Rate successfully updated.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commercialRate = CommercialRate::findOrFail($id);
        $commercialRate->delete();
    }

    // getRateByUuid
    public function getRateByUuid($uuid)
    {
        $commercialRate = CommercialRate::where('uuid', $uuid)->firstOrFail();
        return new CommercialRateResource($commercialRate);
    }
}
