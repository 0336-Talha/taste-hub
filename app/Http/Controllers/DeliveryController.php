<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderTracking;
use App\Models\OrderItem;
use Mail;
class deliveryController extends Controller
{
    //
    public function index(Request $request,$filter=null){
        $orders=OrderTracking::with('order','order.orderMaker.accountUser','order.getCountry','order.getState')->latest()->get();

        if($request->ajax()){
            if($filter== "deliver"){
                $orders=OrderTracking::with('order','order.orderMaker.accountUser','order.getCountry','order.getState')->whereNotNull('is_deliver')->latest()->get();
            return response()->json($orders);


            }else if($filter=="notdeliver"){
                $orders=OrderTracking::with('order','order.orderMaker.accountUser','order.getCountry','order.getState')->whereNull('is_deliver')->latest()->get();
            return response()->json($orders);

            }else{
            return response()->json($orders);
            }
        }
    
        // return $orders;
        return view('admin.deliverAble',compact('orders'));
    }

    public function makeDeliver(Request $request){
        $ord=OrderTracking::where('id',$request->id)->with('order','order.orderMaker.accountUser','order.getCountry','order.getState')->first();
        // return $ord;
        // order.order_maker.account_user.email
        $emailer= $ord->order->orderMaker->accountUser->email;
        $url=url('');
        $url= $url.'/productreview/'.$request->id;
        $orderItem=OrderItem::where('order_trackings_id',$request->id)->with('product')->get()->all();
        // return $orderItem;
        // return $emailer;
        // $prod=OrderItem::where('')
        if($ord) {
            $ord->is_deliver = 1;
            $ord->save();
        }

        Mail::to($emailer)->send(new \App\Mail\DeliveryMail($ord, $orderItem,$url));
        return response()->json('success');
    }
}
