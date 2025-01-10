<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;


use App\Models\OrderTracking;
use App\Models\OwnerReview;

use Auth;
class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $order=OrderTracking::
        with(['order','order.orderMaker',
        'order.items'=> function ($query) use ($id){
            $query->where('order_trackings_id',$id);
        },
        'order.items.product',
        'order.items.product.firstphoto',
        'order.items.product.productReview',
        'order.items.product.productusername',

        'order.items.product.productusername.ownerRating',

        'order.items.product.productuser',

        ])
        ->where('id',$id)->get()->first();

        //yahn 
        // Now let's loop through items and apply the fallback logic
foreach ($order->order->items as $item) {
    // Check if productusername is null
    if ($item->product->productusername === null) {
        // If it's null, get data from OwnerReview where reviewer_id is Auth::id() and owner_id is null
        $ownerReview = \App\Models\OwnerReview::where('reviewer_id', Auth::id())
                                               ->whereNull('product_owner_id')
                                               ->first();  // You can modify 'first()' to 'get()' if you want all

                                            //    if ($ownerReview) {
                                            //     // Assuming productusername is an object or you want to create a new one, you might need to assign like this:
                                            //     // $item->product->productusername = (object)[
                                            //     //     $item->product->productusername->owner_rating = $ownerReview->rating  // You can also assign other attributes here as needed
                                            //     // ];
                                            //     $item->product->productusername = $ownerReview->rating;
                                            // }
        // $item->product->productusername='';
        // Attach the owner review to the product
        $item->product->owner_rating = $ownerReview;

        // // Optionally you can display or process this data
        // if ($ownerReview) {
        //     $item->product->ownerReviewMessage = $ownerReview->review;
        //     $item->product->ownerReviewRating = $ownerReview->rating;
        // } else {
        //     $item->product->ownerReviewMessage = 'No review available';
        //     $item->product->ownerReviewRating = null;
        // }
    }
}
        // return $order;
        // return $order;
        if($order != Null){
        if(Auth::user()->id == $order->order->orderMaker->user_id){
            // return "hello";
            // $order=OrderTracking::
            // with(['order','order.orderMaker',
            // 'order.items'=> function ($query) use ($id){
            //     $query->where('order_trackings_id',$id);
            // },
            // 'order.items.product'
            // ])
            // ->where('id',$id)->get()->first();
            // return $order;
        return view('frontEnd.productReview',compact('order'));

        }else{
            $order=Null;
        }
    }
        return view('frontEnd.productReview',compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function show(ProductReview $productReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductReview $productReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductReview $productReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductReview $productReview)
    {
        //
    }

    public function storeReview(Request $request){
        // return $request->all();
        $validatedData = $request->validate([
            'rating' => 'required',
        ]);
        if($validatedData){
            // return "success";
            $order=[];
            $order['rating']=$request->rating;
            $order['comment']=$request->description;
            $order['product_id']=$request->product_id;
            $order['user_id']=Auth::user()->id;
            $order['order_id']=$request->order_id;


            // return $order;
            $existingReview = ProductReview::where('product_id', $request->product_id)
            ->where('user_id', Auth::user()->id)
            ->first();

                // If the review already exists, update it, else create a new one
    if ($existingReview) {
        $existingReview->update($order);
            return response()->json('Review is Updated Successfully');
         } else {
        ProductReview::create($order);
        return response()->json('Review is created Successfully');
       
    }
            // OrderTracking

        }
        // $order=OrderTracking::
    }

    public function storeAdminReview(Request $request){
        // return $request->all();
             // return $request->all();
             $validatedData = $request->validate([
                'rating' => 'required',
            ]);
            if($validatedData){
                // return "success";
                $order=[];
                $order['rating']=$request->rating;
                $order['comment']=$request->description;
              
                $order['reviewer_id']=Auth::user()->id;
                $order['product_owner_id']=$request->ownerid;
    
                // return $order;
                $existingReview = OwnerReview::where('reviewer_id', Auth::user()->id)->where('product_owner_id',$request->ownerid)
                ->first();
                // return $existingReview;
    
                    // If the review already exists, update it, else create a new one
        if ($existingReview) {
            $existingReview->update($order);
                return response()->json('Review is Updated Successfully');
             } else {
                OwnerReview::create($order);
            return response()->json('Review is created Successfully');
           
        }
                // OrderTracking
    
            }

    }
}
