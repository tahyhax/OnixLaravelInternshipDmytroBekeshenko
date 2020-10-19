<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OrderApiStoreRequest;
use App\Http\Requests\Dashboard\OrderApiUpdateRequest;
use App\Http\Resources\Dashboard\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    protected $perPage = 10;

    /**
     * @param Request $request
     * @return OrderResource
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page') ?: $this->perPage;
        $requests = Order::query()->with(['user','orderItems.product.brand'])
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        return new OrderResource($requests);
    }

    /**
     * @param OrderApiStoreRequest $request
     * @return OrderResource
     */
    public function store(OrderApiStoreRequest $request)
    {
        try {
            $order = new Order($request->all());
            $order->user()->associate($request->get('user'));
            $order->paymentMethod()->associate($request->get('paymentMethods'));
            $order->save();
//
//            $orderItems = [];
//            foreach ($request->get('orderItems') as $item) {
//                $orderItems[] = new OrderItem($item);
//            }
            //NOTE save принимает экземплярмодели а  create массив
            $order->orderItems()->createMany($request->get('orderItems'));
            return  new OrderResource($order->load(['user','orderItems.product.brand']));

        } catch(\Exception $exception) {
            //TODO сделать нормльный $exception
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }


    }

    /**
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order)
    {
        return new OrderResource($order->load(['user','orderItems.product.brand']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderApiUpdateRequest $request, Order $order)
    {
        //TODO как это сделать
        $order->user()->associate($request->get('user'));
        $order->paymentMethod()->associate($request->get('paymentMethods'));
        $order->save();
//        $orderItems = [];
//        foreach ($request->get('orderItems') as $item) {
//            $orderItems[] = new OrderItem($item);
//        }
//        $order->orderItems()->createMany($orderItems);
        //TODO так не правильно дублирутся записи
        $order->orderItems()->createMany($request->get('orderItems'));

        return new OrderResource($order->load(['user','orderItems.product.brand']));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function updateStatus(OrderApiChangeStatusRequest $request, Order $order)
    {
        $order->update('sta');

        return response(null, Response::HTTP_NO_CONTENT);
    }
}