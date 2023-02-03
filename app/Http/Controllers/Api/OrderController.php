<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\Media;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with(['user:id,name', 'media'])
        // ->search($request->q)
        // ->applyFilters($request)
            ->when($request->perPage, function ($query, $perPage) {
                return $query->paginate($perPage);
            }, function ($query) {
                return $query->get();
            })->transform(function ($item, $key) {
            $files = [];
            foreach ($item['media'] as $media) {
                $files[$media['pivot']['tag']] = '/storage/' . $media['directory'] . '/' . $media['filename'] . '.' . $media['extension'];
            }
            return [
                'id' => $item->id,
                'order_id' => $item->order_id,
                'created_at' => $item->created_at,
                'status' => $item->status,
                'comments' => $item->comments,
                'user' => $item->user,
                ...$files,
            ];
        });

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {

        DB::transaction(function () use ($request) {

            $order = Order::create(array_merge($request->validated(), [
                'user_id' => auth()->id(),
            ]));

            if ($request->hasFile('poFile')) {
                $this->uploadFiles($order, $request->file('poFile'), 'poFile');
            }
            if ($request->hasFile('dstFile')) {
                $this->uploadFiles($order, $request->file('dstFile'), 'dstFile');
            }
            if ($request->hasFile('runSheetFile')) {
                $this->uploadFiles($order, $request->file('runSheetFile'), 'runSheetFile');
            }

            $admin = User::find(1);
            $admin->notify(new OrderCreated($order));

        });
        return response()->json(['message' => 'Order successfully created.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->load('audits');
        return new OrderResource($order);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStoreRequest $request, Order $order)
    {
        $order->update($request->validated());

        return response()->json(['message' => 'Order successfully updated.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($orderId)
    {

        DB::transaction(function () use ($orderId) {
            $order = Order::find($orderId);
            $order->media()->delete();
            $order->delete();
        });

        return response()->json([
            'message' => 'Order successfully deleted.',
        ], 200);
    }

    // update user status
    public function updateStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order status successfully updated.'], 200);
    }

    public function assignBrokerToOrder(Request $request)
    {
        Order::query()
            ->whereId($request->orderId)
            ->update([
                'broker_id' => $request->brokerId,
            ]);
        return response()->json(['message' => 'Broker successfully assigned.'], 200);
    }

    public function uploadFiles(Order $order, $file, $tag)
    {
        $media = MediaUploader::fromSource($file)
            ->setMaximumSize(1024 * 1024 * 100)
            ->setStrictTypeChecking(true)
        // ->setAllowedMimeTypes([
        //     'text/csv',
        //     'image/jpg',
        //     'image/jpeg',
        //     'image/png',
        //     'image/gif',
        //     'application/pdf',
        //     'application/msword',
        //     'application/vnd.ms-excel',
        //     'application/zip',
        //     'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        // ])
        // ->setAllowedExtensions(['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv','zip'])
        // ->setAllowedAggregateTypes([
        //     Media::TYPE_IMAGE,
        //     Media::TYPE_SPREADSHEET,
        //     Media::TYPE_DOCUMENT,
        //     Media::TYPE_PDF,
        // ])
            ->useOriginalFilename()
            ->toDirectory($order->id)
            ->upload();
        $order->attachMedia($media, $tag);
        return $media;

    }

}
