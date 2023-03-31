<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CustomerAccountStoreRequest;
use App\Http\Requests\CustomerAccountUpdateRequest;

class CustomerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accounts = Account::query()
            ->where('user_id', $request->user_id)
            ->applyFilters($request)
            ->when($request->perPage, function ($query, $perPage) {
                return $query->orderByDesc('id')->paginate($perPage);
            }, function ($query) {
                return $query->orderByDesc('id')->get();
            });
        return AccountResource::collection($accounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerAccountStoreRequest $request)
    {
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $document = Storage::disk('public')->put('documents', $file);
        } else {
            $document = null;
        }

        Account::create(array_merge($request->validated(), [
            'document' => $document
        ]));

        return response()->json([
            'message' => 'Account successfully created.',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return new AccountResource($account);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerAccountUpdateRequest $request, $id)
    {
        $account = Account::find($id);

        if ($request->hasFile('document')) {
            Storage::delete(storage_path('public/documents' . $account->document));
            Storage::disk('public')->delete($account->document);
            $file = $request->file('document');
            $document = Storage::disk('public')->put('documents', $file);
        } else {
            $document = $account->document;
        }

        Account::where('id', $id)->update(array_merge($request->validated(), [
            'document' => $document,
        ]));

        return response()->json([
            'message' => 'Account successfully updated.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Account::where('id', $id)->delete();
        return response()->json([
            'message' => 'Account successfully deleted.',
        ], 200);
    }

    public function accountFiles(Request $request, $id)
    {
        $this->validate($request, [
            'bill' => 'nullable|mimes:jpeg,jpg,png,pdf,doc,xlsx|max:10000',
            'lor' => 'nullable|mimes:jpeg,jpg,png,pdf,doc,xlsx|max:10000',
            'loa' => 'nullable|mimes:jpeg,jpg,png,pdf,doc,xlsx|max:10000',
            'misc' => 'nullable|mimes:jpeg,jpg,png,pdf,doc,xlsx|max:10000',
            'tax_exempt' => 'nullable|mimes:jpeg,jpg,png,pdf,doc,xlsx|max:10000',
        ]);

        $account = Account::find($id);

        if ($request->hasFile('bill')) {

            if ($account->bill) {
                Storage::delete(storage_path('public/documents' . $account->bill));
                Storage::disk('public')->delete($account->bill);
            }

            $file = $request->file('bill');
            $bill = Storage::disk('public')->put('documents', $file);
        } else {
            $bill = $account->bill;
        }

        if ($request->hasFile('lor')) {

            if ($account->lor) {
                Storage::delete(storage_path('public/documents' . $account->lor));
                Storage::disk('public')->delete($account->lor);
            }

            $file = $request->file('lor');
            $lor = Storage::disk('public')->put('documents', $file);
        } else {
            $lor = $account->lor;
        }

        if ($request->hasFile('loa')) {

            if ($account->loa) {
                Storage::delete(storage_path('public/documents' . $account->loa));
                Storage::disk('public')->delete($account->loa);
            }

            $file = $request->file('loa');
            $loa = Storage::disk('public')->put('documents', $file);
        } else {
            $loa = $account->loa;
        }

        if ($request->hasFile('misc')) {

            if ($account->misc) {
                Storage::delete(storage_path('public/documents' . $account->misc));
                Storage::disk('public')->delete($account->misc);
            }

            $file = $request->file('misc');
            $misc = Storage::disk('public')->put('documents', $file);
        } else {
            $misc = $account->misc;
        }

        if ($request->hasFile('tax_exempt')) {

            if ($account->tax_exempt) {
                Storage::delete(storage_path('public/documents' . $account->tax_exempt));
                Storage::disk('public')->delete($account->tax_exempt);
            }

            $file = $request->file('tax_exempt');
            $tax_exempt = Storage::disk('public')->put('documents', $file);
        } else {
            $tax_exempt = $account->tax_exempt;
        }

        Account::where('id', $id)->update([
            'lor' => $lor,
            'loa' => $loa,
            'bill' => $bill,
            'misc' => $misc,
            'tax_exempt' => $tax_exempt,
        ]);

        return response()->json([
            'message' => 'File successfully uploaded.',
        ], 200);
    }
}
