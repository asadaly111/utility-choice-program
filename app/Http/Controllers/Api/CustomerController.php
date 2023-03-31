<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::query()
        ->applyFilters($request)
        ->when($request->perPage, function ($query, $perPage) {
            return $query->orderByDesc('id')->paginate($perPage);
        }, function ($query) {
            return $query->orderByDesc('id')->get();
        });
        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $document = Storage::disk('public')->put('documents', $file);
        }else{
            $document = null;
        }

        Customer::create(array_merge($request->validated(), [
            'document' => $document,
        ]));

        return response()->json([
            'message' => 'Customer successfully created.',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, $id)
    {
        $customer = Customer::find($id);
        if ($request->hasFile('document')) {

            if($customer->document){
                Storage::delete(storage_path('public/documents'.$customer->document));
                Storage::disk('public')->delete($customer->document);
            }

            $file = $request->file('document');
            $document = Storage::disk('public')->put('documents', $file);
        }else{
            $document = $customer->document;
        }

        Customer::where('id',$id)->update(array_merge($request->validated(), [
            'document' => $document,
        ]));

        return response()->json([
            'message' => 'Customer successfully updated.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json([
            'message' => 'Customer successfully deleted.',
        ], 200);
    }
}
