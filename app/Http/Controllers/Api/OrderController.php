<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Midtrans\CreatePaymentUrlService;

class OrderController extends Controller
{
    //
    public function order(request $request) {
        $order = Order::create([
            'user_id'=>$request->user()->id,
            'seller_id'=>$request->seller_id,
            'number'=>time(),
            'total_price'=>$request->total_price,
            'payment_status'=>1,
            'delivery_address'=>$request->delivery_address,
        ]);

        foreach($request->items as $item) {
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=> $item['id'],
                'quantity'=>$item['quantity'],
            ]);
        }
        // manggil service midtrans untuk dapatkan payment url
        $midtrans = new CreatePaymentUrlService();
        $payment_url = $midtrans->getPaymentUrl($order->load('user','orderItems'));
        //dd('$paymentUrl');
        $order->update([
            'payment_url' =>$payment_url,
        ]);

        return response()->json([
            'data'=>$order
        ])   ;
    }
}
