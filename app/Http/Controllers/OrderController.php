<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\OrderItem;

use App\Models\Product;
use App\Models\Account;
use App\Models\Tbl_country;
use App\Models\Notification;
use App\Models\OrderTracking;
use App\Models\ProductReview;

use App\Models\ProductOffer;




use Auth;
use Stripe;
// use Illuminate\Supports\Facades\Mail;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentIntent;




class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "hi";
        $country=Tbl_country::get()->all();
        $scountry=Tbl_country::get()->all();

        

$user = Cart::where('user_id', Auth::user()->id)
    ->with([
        'product.productuser',       // Product Owner
        'product.productusername',   // Product Info
        'product.ratings',


    
    ])
    ->get();
    // return $user;
    $groupedReviews = [];

// Step 1: Extract owner IDs
$ownerIds = $user->pluck('product.user_id');

// Step 2: Fetch products with `user_id` filter and handle NULL
$products = Product::whereIn('user_id', $ownerIds)
    ->orWhereNull('user_id')
    ->select('id', 'user_id')
    ->get();

// Step 3: Extract product IDs
$productIds = $products->pluck('id');

// Step 4: Fetch reviews for those product IDs
$reviews = ProductReview::whereIn('product_id', $productIds)->get();

// Step 5: Group reviews by user_id
$reviewsGrouped = $reviews->groupBy(function ($review) use ($products) {
    // Find the user_id of the product linked to this review
    $product = $products->firstWhere('id', $review->product_id);
    return $product ? $product->user_id : null; // Handle NULL user_id
});

// return $reviewsGrouped;

// Step 6: Attach reviews to respective products
$productsWithReviews = $products->map(function ($product) use ($reviewsGrouped) {
    // Get all reviews belonging to the user of this product
    $product->reviews = $reviewsGrouped->get($product->user_id, collect()); // Default empty collection
    return $product;
});

// Return final result
// return $productsWithReviews->unique('user_id');
    $productsWithReviews = $productsWithReviews->map(function ($product) {
        // Calculate the sum of ratings
        $product->rating_sum = $product->reviews->sum('rating');
    
        // Count the total number of reviews
        $product->total_reviews = $product->reviews->count();
    
        // Calculate the average rating
        $product->rating_avg = $product->total_reviews > 0
            ? $product->rating_sum / $product->total_reviews
            : 0; // Default to 0 if no reviews
    
        return $product;
    });
    
    // Return the updated collection
    // return $productsWithReviews;
    $prodrev=$productsWithReviews->unique('user_id');


// Initialize an array to store the grouped data
$groupedReviews = [];




        //pluck function
        $uniqueOwners = $user->pluck('product.productuser','product.productusername')->unique('id');
        // return $uniqueOwners;


$rate='';
$uniqueOwners = $user->map(function($cartItem) {
    
    // Check if the product has a user (i.e., not an admin product)
    if ($cartItem->product->productusername && $cartItem->product->productuser) {
        return [
            'user_id'=>$cartItem->product->user_id,
            'name' => $cartItem->product->productusername->name,
            'email' => $cartItem->product->productusername->email,
            'photo' => $cartItem->product->productuser->photo,
         
        ];
    } else {
        // For admin products or missing user data, return some fallback values
        return [
            'user_id'=>'null',
            'name' => 'Admin Product',
            'email' => null,
            'photo' => 'adminimage.jpg',  // Provide a default image for admin products if needed
        ];
    }
})->unique('email'); // Assuming 'email' is unique for each user


$authUser=Auth::user()->id;
$prod=Cart::where('user_id',Auth::user()->id)->with(['product',
'product.productOffer'=>function($query)use($authUser){
    $query->where('user_id', $authUser);
    $query->where('status', 1);

}  

])->with('product.firstPhoto')->get();


$ownersWithReviews = $uniqueOwners->map(function ($owner) use ($prodrev) {
    // Debugging: Dump the user_id
    // dump($owner['user_id']);

    // If the user is an admin (user_id is null or "null" string)
    if (is_null($owner['user_id']) || $owner['user_id'] === '' || $owner['user_id'] === 0 || $owner['user_id'] === '0' || $owner['user_id'] === 'null') {
        // Admin logic: Calculate average rating for admin products
        // dump($owner);  // Shows the owner if user_id is null, empty, or "null" (string)

        $adminReviews = collect($prodrev)->filter(function ($prod) {
            return is_null($prod['user_id']); // Filter for admin products (user_id is null)
        });

        if ($adminReviews->isNotEmpty()) {
            $ratingSum = $adminReviews->sum('rating_sum');
            $totalReviews = $adminReviews->sum('total_reviews');

            $averageRating = $totalReviews > 0 ? $ratingSum / $totalReviews : 0;

            $owner['average_rating'] = $averageRating;
            $owner['total_reviews_count'] = $totalReviews;
        } else {
            $owner['average_rating'] = 0;
            $owner['total_reviews_count'] = 0;
        }
    } else {
        // For regular users, calculate their average rating and total review count
        $userReviews = collect($prodrev)->filter(function ($prod) use ($owner) {
            return $prod['user_id'] == $owner['user_id']; // Filter reviews by user_id
        });

        if ($userReviews->isNotEmpty()) {
            // Calculate the sum of ratings and total reviews for the user
            $ratingSum = $userReviews->sum('rating_sum');
            $totalReviews = $userReviews->sum('total_reviews');
            
            $averageRating = $totalReviews > 0 ? $ratingSum / $totalReviews : 0;
            
            // Assign the calculated values
            $owner['average_rating'] = $averageRating;
            $owner['total_reviews_count'] = $totalReviews;
        } else {
            // If no reviews for the user, assign default values
            $owner['average_rating'] = 0;
            $owner['total_reviews_count'] = 0;
        }
    }

    return $owner;
});

// return $ownersWithReviews;

// Debug output: Check final values for owners with reviews
// dd($ownersWithReviews);

    // return $prodrev;
    

        return view('frontEnd.checkout',compact('ownersWithReviews','prod','country','scountry'));
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }



    public function paymentRequest(Request $request){
        // dd($request->all());
        // $stripeClient=\Stripe\Stripe::setApiKey("sk_test_51OLrSyFz9lIBjWEq28ygYawS3vaXAKLi1ruHjNGlgfgzxl4WCkwwRl7ctVldi7sczg0fJ6XJ9Z4f5aPKsTNuy4vg00fHkBXhaw");
        \Stripe\Stripe::setApiKey("sk_test_51OLrSyFz9lIBjWEq28ygYawS3vaXAKLi1ruHjNGlgfgzxl4WCkwwRl7ctVldi7sczg0fJ6XJ9Z4f5aPKsTNuy4vg00fHkBXhaw");

        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount*100, // Amount in cents
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        // return $paymentIntent;
        return response()->json(['clientSecret' => $paymentIntent->client_secret]);

 }


 public function workOnPayment(Request $request){
    // return $request->all();
    $order=new Order();
    $order['name']=$request->bfname.' '.$request->blname;
    $order['address']=$request->baddress;
    $order['zip']=$request->bzip;
    $order['city']=$request->bcity;
    $order['country_id']=$request->bcountry;
    $order['state_id']=$request->bstate;
    $order['user_id']=Auth::user()->id;

    $order['payment_intent_id']=$request->paymentIntentId;
    $order['payment_status']=$request->paymentStatus;

    $order->save();

    if($request->differ_shipping == 'on'){
        // return "okay hai";
        $order1=new Order();
        $order1['name']=$request->bfname.' '.$request->blname;
        $order1['address']=$request->baddress;
        $order1['zip']=$request->bzip;
        $order1['city']=$request->bcity;
        $order1['country_id']=$request->bcountry;
        $order1['state_id']=$request->bstate;
        $order1['user_id']=Auth::user()->id;
        $order1['order_id']=$order->id;
        $order1['payment_intent_id']=$request->paymentIntentId;
        $order1['payment_status']=$request->paymentStatus;
        $order1->save();
        // return "okay hai";

    }else{
        // return "not Okay";
    }

     $items=Cart::where('user_id',Auth::user()->id)->get();
     //yahn paa dn ga product price :-o 
    //  return $item;
    $offer=ProductOffer::where('status',1)->where('user_id',Auth::user()->id)->with('product')->get();
    foreach($items as $data){
        $orderItem=new OrderItem();
        $orderItem->order_id=$order->id;
        $orderItem->qty=$data->qty;
        $orderItem->product_id=$data->product_id;
        // $orderItem->product_id=$data->product_id;
        if($offer){
        foreach($offer as $off)
            if($data->product_id == $off->product->id){
                $orderItem->offerPrice=$off->offerPrice;

                $off->status=2; 
                $off->save();
              
                $noti = new Notification();
                $noti['user_id'] = $off->user_id;
                $noti['type'] = 'Your Offer Has Been Expired';
                $noti['message'] = 'Your Offer of the product ' . $off->product->title . ' Has Been Expired';  // Corrected concatenation
                $noti['photo'] = $off->product->firstPhoto->photo_path;
                $noti['link'] = '/productDetail/' . $off->product_id;  // Corrected concatenation
                $noti->save();
            }
        }
        
        $orderItem->size_id=$data->size;
        $orderItem->color_id=$data->color;       
        $orderItem->save();

    }

    $notification=new Notification();
    $notification->user_id=Auth::user()->id;
    $notification->type='Created a Order';
    // $notification->message='You have created a new order for Jennifer Kem click here to view detail.';

    $items = Cart::where('user_id', Auth::user()->id)->get();

$data = Cart::where("user_id", Auth::user()->id)->with('product')->get();
$outOfStockProductsForUser = []; // For user products
$outOfStockProductsForAdmin = []; // For admin products

$userPurchaseitems = []; // For admin products



//notification
$ownersList=[];
$photo='';

//user ids
$ownersId=[]; //product ky owner
//admin Ids
$adminId=[];
//admin prod
$adminProdNoti=[]; //admin products
//user prod
$userProdNoti=[]; //user products.

//chat
$ownerNotifications = [];

//admin notification.
$adminNotifications = [];




if ($data != NULL) {
    foreach ($data as $prod) {
        // return $prod;
        // Ensure that the product relationship is loaded and that the product has a quantity
        if (isset($prod->product->quantity)) {
          
            $remainingQty = $prod->product->quantity - $prod->qty;

            if ($prod->product->is_admin == 1) {
               
                $ownerName='Admin';
                $photo='/noimage.jpg';
                $adminId='unique';
                $adminNotifications[$adminId][]=$prod->product->title;
                
                //name of owners that are not in list
                // $ownerName = $prod->product->is_admin == 1 ? 'Admin' : $prod->product->productusername; // Assuming you have the owner's name
            }else{
                $ownerName=$prod->product->productusername->name;
                $photo=$prod->product->productuser->photo;
                // $ownid=$prod->product->productusername->id;
                $ownersId=$prod->product->productusername->id;
                // $userProd=$prod->product->title;
                // $userProd[$ownersId][] = $prod->product->title;

                $ownerNotifications[$ownersId][] = $prod->product->title;
                
                
            }
            if (!in_array($ownerName, $ownersList)) {
                $ownersList[] = $ownerName;
            }

           
            $userPurchaseitems[]=$prod->product;
                // Update the product's quantity in the database
                $prod->product->update(['quantity' => $remainingQty]);
            // return $prod->product->productusername;
                if ($remainingQty <= 0) {
                    // $outOfStockProducts[] = $prod->product;
                       // Add the product to the appropriate array
                if ($prod->product->is_admin == 1) {
                    $outOfStockProductsForAdmin[] = $prod->product; // Admin product
                    // $ownerName='Admin';
                    // $photo='/noimage.jpg';
                    //name of owners that are not in list
                    // $ownerName = $prod->product->is_admin == 1 ? 'Admin' : $prod->product->productusername; // Assuming you have the owner's name
            
                   
                            // $userPurchaseitems[]=$prod->product;
                } else {
                    $outOfStockProductsForUser[] = $prod->product; // User product
                    // $userPurchaseitems[]=$prod->product;
                } 
            }

                  
                
        }

            // If there are out-of-stock products, send a single email
    }

    
}

if (!empty($outOfStockProductsForAdmin)) {
    $msg = "The following admin products are out of stock:";
    foreach ($outOfStockProductsForAdmin as $adminProduct) {
        $msg .= "\n - " . $adminProduct->title; // Assuming 'name' is a property of the product
    }
   
    Mail::to('admin@gmail.com')->send(new \App\Mail\ProductOutOfStock($msg, $outOfStockProductsForAdmin));
}

if (!empty($outOfStockProductsForUser)) {
    $msg = "The following items are out of stock:";
    foreach ($outOfStockProductsForUser as $userProduct) {
        $msg .= "\n - " . $userProduct->name; // Assuming 'name' is a property of the product
    }

    // Assuming the first product's user can be contacted
    $owner = $outOfStockProductsForUser[0]->productusername; // Assuming you have a relationship called 'productuser'
    if ($owner) {
        Mail::to($owner->email)->send(new \App\Mail\ProductOutOfStock($msg, $outOfStockProductsForUser));
    }
}

$ownersListString = implode(', ', $ownersList);
$notificationMessage = "You have created a new order for $ownersListString. Click here to view details.";

$notification->message = $notificationMessage;
$notification->photo = $photo;
$notification->link='order/'.$order->id;
$notification->save();

$photosing=Account::select('photo')->where('user_id',Auth::user()->id)->get()->first();
$name=Auth::user()->name;
// Create notifications for each owner
foreach ($ownerNotifications as $ownerId => $products) {
    $notification = new Notification();
    $notification->user_id = $ownerId;
    $productNames = implode(', ', $products);
    $notification->message = "An order was placed by $name for the following products: $productNames.";
    if($photosing == Null){
    $notification->photo='/noimage.jpg';
    }else{
    $notification->photo=$photosing->photo;
    }
    $notification->type='Got new Order';

    $notification->link='/orderInfo/'.$order->id;

    $notification->save();
}
if(!empty($adminNotifications)){
    foreach($adminNotifications as $adminId=> $product){
        $notification = new Notification();
        $notification->user_id =Null;
        $productNames = implode(', ', $product);
        $notification->message = "An order was placed by $name for the following products: $productNames.";
        if($photosing == Null){
            $notification->photo='/noimage.jpg';
            }else{
            $notification->photo=$photosing->photo;
         }
        $notification->type='Got new Order';
    
        $notification->link='/this is link';
    
        $notification->save();

    }
}




if (!empty($userPurchaseitems)) {
    $msg = "The following item has been Order:";
    foreach ($userPurchaseitems as $item) {
        $msg .= "\n - " . $item->title; // Assuming 'name' is a property of the product
    }

    
    if (Auth::user()) {
        Mail::to(Auth::user()->email)->send(new \App\Mail\OrderSuccessfull($msg, $userPurchaseitems));
    }
}

//delete all carts items

// Cart::where('user_id', Auth::user()->id)->delete();
//  return response()->json(['successfully']);

    // Set the session flash message
    // session()->flash('success', 'Payment processed successfully.');

return response()->json([
    'status' => 'success',
    'redirectUrl' => route('web.home') // Replace with your success route
]);




 }
  
 public function ordersPage(){

$ownerId = Auth()->id(); // Specific owner ID ke hisaab se filter karne ke liye
$orders = Order::whereHas('items.product', function ($query) use ($ownerId) {
    $query->where('user_id', $ownerId);
})

->with('orderMaker.accountUser','items.product') // Related product and photo data include karne ke liye
->latest()->paginate(6);

// return $orders;
//  return $orders;

return view('frontEnd.orders',compact('orders'));
       
 }

 public function orderinfo($id){
    
  
   
    $orders= Order::whereHas('items',function($query) use ($id){
        $query->where('order_id',$id);
    // })->whereHas('items.product',function($query) {
    //     $query->whereNull('user_id');
    })->with([
        // 'items.product',
        'items.product.firstPhoto',
        'items.product.getProductCol',
        'items.product.getProductSiz',
        'items.trackingNumber',

    
            //     'items.product' => function ($query) {
            //     $query->with(['getProductCol']);
            //     $query->with(['getProductSiz']);
            // },
            // 'items.product' => function ($query) {
            //     $query->with(['getProductSiz']);
            // },
    
        //     'items.productSize',
        //     'items.product' => function ($query) {
        //     $query->with(['getProductSiz']);
        // },
        // 'items.product.productColors',
        // 'items.product.productSize',
        'items.product.subCategory',
        'items.product.subCategory.MainCategory',
        'orderMaker',
        'items.order.getState',
        'items.order.getCountry',
    ]
    
                          
        
        )
        ->get()->first();


        // return $orders;
    return view('frontEnd.orderinfo',compact('orders'));
   
 }

 public function updateTrackNo(Request $request){
   
    // return $request->all();
    // $orderitem=OrderItem::where('id',$request->itemid)->update('trackNo',$request->trackNo);
    // $orderItem = OrderItem::where('id', $request->itemid)
    // ->update(['trackNo' => $request->trackNo]);

        // Order ke items ko laayenge aur owner ke hisaab se group karenge
        // $orderItems = OrderItem::where('order_id', $request->itemid)
        // ->with('product')
        // ->get()
        //  ->groupBy('product.user_id');

        // return $orderItems;
        $orderItems = OrderItem::where('order_id', $request->itemid)
    ->whereHas('product', function($query) {
        $query->whereNotNull('user_id')->where('user_id',Auth::user()->id);  // Sirf woh products jinke user_id non-null hain
    })
    ->with('product')
    ->get()
    ->groupBy('product.user_id'); // user_id ke hisaab se group karna

        // return $orderItems;
        

        foreach ($orderItems as $ownerId => $items) {
            // echo $items;
            //group by collection instant...
                // Group mein pehle item se `order_id` aur `user_id` lete hain
            $firstItem = $items->first();
            // Agar owner ke liye tracking number pehle se nahi hai toh naya create karenge
            $tracking = OrderTracking::updateOrCreate (
                [
                    'order_id' => $firstItem->order_id,
                    'owner_id' => $firstItem->product->user_id,
                ],
                [
                    'tracking_number' => $request->trackNo,
                ]
            );
    
            foreach ($items as $item) {
                $item->order_trackings_id = $tracking->id;
                $item->save();
            }
            // Owner ke saare items mein tracking number link karenge
            // foreach ($items as $item) {
            //     $item->tracking_number_id = $tracking->id;
            //     $item->save();
            // }
        }
    
    




// Optionally return a response
    return response()->json(['success' => true, 'message' => 'Tracking number updated successfully.']);
 }

 public function userOrderDetail($id){
    // $order=OrderItem::where('order_id',$id)->
    // with('product','product.productColor','order')
    
    // ->get();
    $order = OrderItem::where('order_id', $id)
    ->with([
        'product' => function ($query) {
            $query->with('productColors', 'productSize');
        },

        'order',
        'trackingNumber',
        'order.getState',
        'order.getCountry',
    ])
    ->get();
    // return $order;
    return view('frontEnd.userWholeOrderDetail',compact('order'));
   
 }

}