<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductOffer; 
  
use Illuminate\Http\Request;
use Auth;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $offer;
        $authUser=Auth::user()->id;
        // $offer=ProductOffer::where('user_id',$authUser)->where('status','1')->get(); 
        // return $productoffer;  
        
        // if($offer->isEmpty()){
        //     $offer=1;
        // }
 
        // $offer=Null;
        $cart=Cart::where('user_id',$authUser)->with(['product.firstPhoto',
        'product.productOffer'=>function($query)use($authUser){
            $query->where('user_id', $authUser);
            $query->where('status', 1);

        }
        ])
        
        ->get()->all();  
        // return $cart;   

        return view('frontEnd.cart',compact('cart')); 
        // return $cart;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {   
        $qty=0;
        if($request->input('qty')== null){
            $qty=1;
        }else{
            $qty=$request->qty;
        }

        $authUser=Auth::user()->id;
        // return $request->all();
        // $check=Cart::where('user_id',$authUser)->where('product_id',)

        $ok=Cart::updateOrCreate([
            'user_id'=>$authUser,
            'product_id'=>$request->product_id,
        ],[
            'user_id'=>$authUser,
            'product_id'=>$request->product_id,
            'color'=>$request->selected_color,
            'size'=>$request->selected_size,
            'qty'=>$qty

        ]);
        // $car=new Cart();
        // $car->user_id=Auth::user()->id;
        // $car->product_id=$request->product_id;
        // $car->color=$request->selected_color;
        // $car->size=$request->selected_size;
    
        // $car->save();
        return response()->json(['success'=>'success', 'redirect_url'=>route('user.cartIndex')]);
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
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function Remove(Cart $cart,$id)
    {
        //
        $car=Cart::where('id',$id)->delete();
        return response()->json(['success']);
    }

    public function cartToQty(Request $request){
        $car=Cart::where('id',$request->id)->update(['qty'=>$request->qty]);
        return response()->json(['success']);
    }
}
