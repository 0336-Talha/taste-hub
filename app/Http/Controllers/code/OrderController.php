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

        
        // main na jo product a rhi hain pechy sy unki base py unka owner ly liya orrr sari product jinka owner voh bnda hai us py rating sy data utha liya jitni bhi rows hain product review ki,

        // $user=Cart::with('product')->with('product.productuser')->with('product.productusername')->get();
//         $user=Cart::where('user_id',Auth::user()->id)->with(
//             'product.productuser',
//             'product.productusername',
     
//         // 'product.productusername.ownerRatings'
//         )->get();
//         $counter=[];

//         // Extract the owner IDs from the cart products
// // $ownerIds = $user->pluck('product.user_id')->unique();
// // Step 2: Extract unique owner IDs (filter out admin products with null user_id)
// $ownerIds = $user->pluck('product.user_id')->filter(function ($value) {
//     return !is_null($value);  // Filter out null user_id for admin products
// })->unique();

// // return $ownerIds;
// // Step 3: Check if there are any admin products (where user_id is null)
// $adminProductsInCart = $user->where('product.user_id', null)->isNotEmpty();


// // Step 3: Get reviews for all products of these owners from cart
// $productReviews = ProductReview::whereIn('product_id', function ($query) use ($ownerIds) {
//     $query->select('id')
//         ->from('products')
//         ->whereIn('user_id', $ownerIds);  // Only for products owned by the owners in the cart
// })
// ->get();
// $ownerReviews = ProductReview::whereIn('product_id', function ($query) use ($ownerIds) {
//     $query->select('id')
//         ->from('products')
//         ->whereIn('user_id', $ownerIds);  // Including all products, regular and admin
// }) 
// ->get();
// // Step 5: If admin products are in the cart, fetch their reviews
// if ($adminProductsInCart) {
//     $adminProductReviews = ProductReview::whereIn('product_id', function ($query) use ($ownerIds) {
//         $query->select('id')
//             ->from('products')
//             ->whereNull('user_id');  // Only fetch admin products if they exist in the cart
//     })
//     ->get();
// } else {
//     $adminProductReviews = collect();  // Empty collection if no admin products
// }

// foreach ($user as $cartItem) {
//     $ownerId = $cartItem->product->user_id;
    
//     // Get reviews for this owner
//     $ownerProductReviews = $ownerReviews->filter(function ($review) use ($ownerId) {
//         return $review->product->user_id == $ownerId;
//     });

//     // Add reviews to the cart item
//     $cartItem->owner_reviews = $ownerProductReviews;

//     // If the product is admin-owned, add admin reviews as well
//     if (is_null($ownerId)) {
//         $cartItem->owner_reviews = $cartItem->owner_reviews->merge($adminProductReviews);
//     }
// }

// / Step 4: Loop through each cart item and calculate ratings and reviews for each owner
// foreach ($user as $cartItem) {
//     $ownerId = $cartItem->product->user_id;

//     // Get reviews for this owner
//     $ownerProductReviews = $productReviews->filter(function ($review) use ($ownerId) {
//         return $review->product->user_id == $ownerId;
//     });

//     // Calculate the total rating and review count for this owner
//     $totalRating = $ownerProductReviews->sum('rating'); // Sum of all ratings for this owner
//     $reviewCount = $ownerProductReviews->count(); // Total number of reviews for this owner

//     // Calculate the average rating (if reviews exist)
//     $averageRating = $reviewCount > 0 ? $totalRating / $reviewCount : 0;

//     // Attach review count and average rating to the cart item
//     $cartItem->owner_review_count = $reviewCount;
//     $cartItem->owner_average_rating = $averageRating;
// }
// Step 1: Get the cart data with product owner information
$user = Cart::where('user_id', Auth::user()->id)
    ->with([
        'product.productuser',       // Product Owner
        'product.productusername',   // Product Info
        'product.ratings',

    
    ])
    ->get();
    // return $user;
    $groupedReviews = [];

    $ownerIds = $user->pluck('product.user_id');


// Loop through each product in the cart to group reviews by product owner (user_id)
// foreach ($user as $cartItem) {
//     // Get the product owner (user_id)
//     $productOwnerId = $cartItem->product->user_id;

//     // If the product has reviews, process them
//     if ($cartItem->product->ratings->isNotEmpty()) {
//         // Loop through the reviews and add them to the grouped data
//         foreach ($cartItem->product->ratings as $review) {
//             // If the product owner (user_id) doesn't exist in the grouped array, add it
//             if (!isset($groupedReviews[$productOwnerId])) {
//                 $groupedReviews[$productOwnerId] = [
//                     'owner' => $cartItem->product->productusername,  // Product owner's details
//                     'reviews' => []  // Initialize an empty array for reviews
//                 ];
//             }

//             // Add the review to the owner's reviews array
//             $groupedReviews[$productOwnerId]['reviews'][] = [
//                 'review_id' => $review->id,
//                 'comment' => $review->comment,
//                 'rating' => $review->rating,
//                 'reviewer_name' => $review->user->name,  // Reviewer name
//                 'reviewer_email' => $review->user->email, // Reviewer email
//             ];
//         }
//     }

//     // Handle admin products (where user_id is null)
//     if ($productOwnerId === null) {
//         $adminProduct = $cartItem->product;
//         // If the admin product has reviews, process them
//         if ($adminProduct->ratings->isNotEmpty()) {
//             foreach ($adminProduct->ratings as $review) {
//                 // If admin doesn't exist in the grouped array, initialize it
//                 if (!isset($groupedReviews['admin'])) {
//                     $groupedReviews['admin'] = [
//                         'owner' => 'Admin',  // Static label for Admin
//                         'reviews' => []  // Initialize an empty array for reviews
//                     ];
//                 }

//                 // Add the admin's review to the 'admin' section
//                 $groupedReviews['admin']['reviews'][] = [
//                     'review_id' => $review->id,
//                     'comment' => $review->comment,
//                     'rating' => $review->rating,
//                     'reviewer_name' => $review->user->name,  // Reviewer name
//                     'reviewer_email' => $review->user->email, // Reviewer email
//                 ];
//             }
//         }
//     }
// }
// $groupedReviews = [];

// Loop through each product in the cart to group reviews by product owner (user_id)
// foreach ($user as $cartItem) {
//     // Get the product owner (user_id)
//     $productOwnerId = $cartItem->product->user_id;

//     // Initialize variables for average rating and review count
//     $totalRating = 0;
//     $totalReviews = 0;

//     // If the product has reviews, process them
//     if ($cartItem->product->ratings->isNotEmpty()) {
//         // Loop through the reviews and add them to the grouped data
//         foreach ($cartItem->product->ratings as $review) {
//             // Sum up the ratings for average calculation
//             $totalRating += $review->rating;
//             // Count the reviews
//             $totalReviews++;

//             // If the product owner (user_id) doesn't exist in the grouped array, add it
//             if (!isset($groupedReviews[$productOwnerId])) {
//                 $groupedReviews[$productOwnerId] = [
//                     'owner' => $cartItem->product->productusername,  // Product owner's details
//                     'reviews' => [],  // Initialize an empty array for reviews
//                     'total_rating' => 0,  // Initialize total rating
//                     'total_reviews' => 0   // Initialize total reviews count
//                 ];
//             }

//             // Add the review to the owner's reviews array
//             $groupedReviews[$productOwnerId]['reviews'][] = [
//                 'review_id' => $review->id,
//                 'comment' => $review->comment,
//                 'rating' => $review->rating,
//                 'reviewer_name' => $review->user->name,  // Reviewer name
//                 'reviewer_email' => $review->user->email, // Reviewer email
//             ];
//         }

//         // After processing the reviews, calculate the average rating for the product owner
//         $groupedReviews[$productOwnerId]['total_rating'] += $totalRating;
//         $groupedReviews[$productOwnerId]['total_reviews'] += $totalReviews;
//     }

//     // Handle admin products (where user_id is null)
//     if ($productOwnerId === null) {
//         $adminProduct = $cartItem->product;
//         // If the admin product has reviews, process them
//         if ($adminProduct->ratings->isNotEmpty()) {
//             foreach ($adminProduct->ratings as $review) {
//                 // Sum up the ratings for average calculation
//                 $totalRating += $review->rating;
//                 // Count the reviews
//                 $totalReviews++;

//                 // If admin doesn't exist in the grouped array, initialize it
//                 if (!isset($groupedReviews['admin'])) {
//                     $groupedReviews['admin'] = [
//                         'owner' => 'Admin',  // Static label for Admin
//                         'reviews' => [],  // Initialize an empty array for reviews
//                         'total_rating' => 0,  // Initialize total rating
//                         'total_reviews' => 0   // Initialize total reviews count
//                     ];
//                 }

//                 // Add the admin's review to the 'admin' section
//                 $groupedReviews['admin']['reviews'][] = [
//                     'review_id' => $review->id,
//                     'comment' => $review->comment,
//                     'rating' => $review->rating,
//                     'reviewer_name' => $review->user->name,  // Reviewer name
//                     'reviewer_email' => $review->user->email, // Reviewer email
//                 ];
//             }

//             // After processing the reviews, calculate the average rating for the admin
//             $groupedReviews['admin']['total_rating'] += $totalRating;
//             $groupedReviews['admin']['total_reviews'] += $totalReviews;
//         }
//     }
// }

// Initialize an array to store the grouped data
$groupedReviews = [];

// Loop through each product in the cart to group reviews by product owner (user_id)
foreach ($user as $cartItem) {
    // Get the product owner (user_id)
    $productOwnerId = $cartItem->product->user_id;

    // Initialize variables for average rating and review count
    $totalRating = 0;
    $totalReviews = 0;

    // If the product has reviews, process them
    if ($cartItem->product->ratings->isNotEmpty()) {
        // Loop through the reviews and add them to the grouped data
        foreach ($cartItem->product->ratings as $review) {
            // Sum up the ratings for average calculation
            $totalRating += $review->rating;
            // Count the reviews
            $totalReviews++;

            // If the product owner (user_id) doesn't exist in the grouped array, add it
            if (!isset($groupedReviews[$productOwnerId])) {
                $groupedReviews[$productOwnerId] = [
                    'owner' => $cartItem->product->productusername,  // Product owner's details
                    'reviews' => [],  // Initialize an empty array for reviews
                    'total_rating' => 0,  // Initialize total rating
                    'total_reviews' => 0,   // Initialize total reviews count
                ];
            }

            // Add the review to the owner's reviews array
            $groupedReviews[$productOwnerId]['reviews'][] = [
                'review_id' => $review->id,
                'comment' => $review->comment,
                'rating' => $review->rating,
                'reviewer_name' => $review->user->name,  // Reviewer name
                'reviewer_email' => $review->user->email, // Reviewer email
            ];
        }

        // After processing the reviews, calculate the total rating and reviews count for the product owner
        $groupedReviews[$productOwnerId]['total_rating'] += $totalRating;
        $groupedReviews[$productOwnerId]['total_reviews'] += $totalReviews;
    }

    // Handle admin products (where user_id is null)
    if ($productOwnerId === null) {
        $adminProduct = $cartItem->product;
        // If the admin product has reviews, process them
        if ($adminProduct->ratings->isNotEmpty()) {
            foreach ($adminProduct->ratings as $review) {
                // Sum up the ratings for average calculation
                $totalRating += $review->rating;
                // Count the reviews
                $totalReviews++;

                // If admin doesn't exist in the grouped array, initialize it
                if (!isset($groupedReviews['admin'])) {
                    $groupedReviews['admin'] = [
                        'owner' => 'Admin',  // Static label for Admin
                        'reviews' => [],  // Initialize an empty array for reviews
                        'total_rating' => 0,  // Initialize total rating
                        'total_reviews' => 0,   // Initialize total reviews count
                    ];
                }

                // Add the admin's review to the 'admin' section
                $groupedReviews['admin']['reviews'][] = [
                    'review_id' => $review->id,
                    'comment' => $review->comment,
                    'rating' => $review->rating,
                    'reviewer_name' => $review->user->name,  // Reviewer name
                    'reviewer_email' => $review->user->email, // Reviewer email
                ];
            }

            // After processing the reviews, calculate the total rating and reviews count for the admin
            $groupedReviews['admin']['total_rating'] += $totalRating;
            $groupedReviews['admin']['total_reviews'] += $totalReviews;
        }
    }
}

// Now calculate the average rating for each product owner
foreach ($groupedReviews as $ownerId => &$data) {
    // Calculate average rating if there are any reviews
    if ($data['total_reviews'] > 0) {
        $data['average_rating'] = $data['total_rating'] / $data['total_reviews'];
    } else {
        $data['average_rating'] = 0;  // No reviews, so set average to 0
    }

    // Adding total reviews count to the data
    $data['total_reviews_count'] = $data['total_reviews'];
}

return $groupedReviews;

// Output the grouped reviews for each product owner
// foreach ($groupedReviews as $ownerId => $data) {
//     echo "Owner: " . ($ownerId === 'admin' ? 'Admin' : $data['owner']->name) . "<br>";
//     echo "Reviews:<br>";

//     foreach ($data['reviews'] as $review) {
//         echo "- Review ID: " . $review['review_id'] . "<br>";
//         echo "  Comment: " . $review['comment'] . "<br>";
//         echo "  Rating: " . $review['rating'] . "<br>";
//         echo "  Reviewer: " . $review['reviewer_name'] . "<br>";
//         echo "  Reviewer Email: " . $review['reviewer_email'] . "<br><br>";
//     }
// }
    // return $ownerIds;
    // $reviews = ProductReview::whereHas('product', function ($query) use ($ownerIds) {
    //     // Match the product's owner (user_id) with ownerIds
    //     // $query->whereIn('user_id', $ownerIds);
    //     $query->whereIn('user_id', $ownerIds)
    //     ->orWhereNull('user_id');
    // })
    // ->with([
    //     'product.productuser',  // Fetch product owner details
    //     'product.productusername'  // Fetch product details (name, description)
    // ])
    // ->get();

    // $groupedReviews = $reviews->groupBy(function($review) {
    //     // Group by product owner ID (user_id)
    //     return $review->product->user_id;
    // });
    // return $groupedReviews;
 


// Step 2: Extract unique owner IDs from cart items (including admin products)
// $ownerIds = $user->pluck('product.user_id')->filter(function ($value) {
//     return !is_null($value);  // Only include non-null user IDs for vendors (filter out admin if null)
// })->unique();

// // Step 3: Fetch all product reviews for these owners (including admin if user_id is null)
// $productReviews = ProductReview::whereIn('product_id', function ($query) use ($ownerIds) {
//     $query->select('id')
//         ->from('products')
//         ->whereIn('user_id', $ownerIds);  // Only products owned by the extracted owners
// })
// ->get();

// // Step 4: Separate handling for admin products (where user_id is null)
// $adminProductReviews = collect(); // Default empty collection for admin reviews

// // Check if there are admin products in the cart
// $adminProductsInCart = $user->where('product.user_id', null)->isNotEmpty();

// if ($adminProductsInCart) {
//     // Get reviews for admin products (where user_id is null)
//     $adminProductReviews = ProductReview::whereIn('product_id', function ($query) {
//         $query->select('id')
//             ->from('products')
//             ->whereNull('user_id');  // Only admin products where user_id is null
//     })
//     ->get();
// }

// // Step 5: Loop through each cart item and calculate reviews, rating count, and average for each owner
// foreach ($user as $cartItem) {
//     $ownerId = $cartItem->product->user_id;

//     // If the owner is not null, calculate the reviews for that owner
//     $ownerProductReviews = $productReviews->filter(function ($review) use ($ownerId) {
//         return $review->product->user_id == $ownerId;
//     });

//     // Calculate total rating and review count for this owner
//     $totalRating = $ownerProductReviews->sum('rating'); // Sum of ratings
//     $reviewCount = $ownerProductReviews->count(); // Count of reviews
//     $averageRating = $reviewCount > 0 ? $totalRating / $reviewCount : 0;

//     // Attach owner reviews count and average rating to the cart item
//     $cartItem->owner_review_count = $reviewCount;
//     $cartItem->owner_average_rating = $averageRating;

//     // If the product owner is admin (user_id is null), merge admin reviews
//     if (is_null($ownerId)) {
//         $adminOwnerReviews = $adminProductReviews->filter(function ($review) use ($cartItem) {
//             return $review->product_id == $cartItem->product->id;
//         });
//         $adminTotalRating = $adminOwnerReviews->sum('rating');
//         $adminReviewCount = $adminOwnerReviews->count();
//         $adminAverageRating = $adminReviewCount > 0 ? $adminTotalRating / $adminReviewCount : 0;

//         // Attach admin reviews to the cart item
//         $cartItem->owner_review_count = $adminReviewCount;
//         $cartItem->owner_average_rating = $adminAverageRating;
//     }
// }


// return $user;
// return $ownerReviews;



        // return $ownerIds;

        // $ownerReviews = ProductReview::whereIn('product_id', function ($query) use ($ownerIds) {
        //     // Get all products from the owners that are in the cart
        //     $query->select('id')
        //         ->from('products')
        //         ->whereIn('user_id', $ownerIds);
        // })
        // ->get();

        // foreach ($user as $cartItem) {
        //     $ownerId = $cartItem->product->user_id;
        
        //     // Filter reviews for this owner
        //     $ownerProductReviews = $ownerReviews->filter(function ($review) use ($ownerId) {
        //         return $review->product->user_id == $ownerId;
        //     });
        
        //     // Add reviews to cart item
        //     $user->owner_reviews = $ownerProductReviews;
        // }

        // return $user;
        // distinct()
        // return $user;
        // foreach($user as $owner){
            
        //     $rate=\App\Models\OwnerReview::where('product_owner_id',$owner->product->user_id)->get();
        // }
        // return $rate;
        // foreach ($user as $item) {
            
        //     // Check if productusername is null
        //     if ($item->product->user_id === Null) {
               
                
        //         // If it's null, get data from OwnerReview where reviewer_id is Auth::id() and owner_id is null
        //         $ownerReview = \App\Models\OwnerReview::
        //                                             whereNull('product_owner_id')
                                          
        //                                                ->get();  // You can modify 'first()' to 'get()' if you want all
        
        //                                             //    if ($ownerReview) {
        //                                             //     // Assuming productusername is an object or you want to create a new one, you might need to assign like this:
        //                                             //     // $item->product->productusername = (object)[
        //                                             //     //     $item->product->productusername->owner_rating = $ownerReview->rating  // You can also assign other attributes here as needed
        //                                             //     // ];
        //                                             //     $item->product->productusername = $ownerReview->rating;
        //                                             // }
        //         // $item->product->productusername='';
        //         // Attach the owner review to the product
        //         $item->product->owner_rating = $ownerReview;
        
        //         // $counter=count($ownerReview);
        //         // // Optionally you can display or process this data
        //         // if ($ownerReview) {
        //         //     $item->product->ownerReviewMessage = $ownerReview->review;
        //         //     $item->product->ownerReviewRating = $ownerReview->rating;
        //         // } else {
        //         //     $item->product->ownerReviewMessage = 'No review available';
        //         //     $item->product->ownerReviewRating = null;
        //         // }
        //     }
        // }

        // return $uniqueOwners;
        // return $user;


        //pluck function
        // $uniqueOwners = $user->pluck('product.productuser','product.productusername')->unique('id');
        // return $uniqueOwners;

        //map function
        // Map over the cart items to combine both the productuser and productusername
// $uniqueOwners = $user->map(function($cartItem) {
//     return [
//         'name' => $cartItem->product->productusername->name,
//         'photo' => $cartItem->product->productuser->photo,
//     ];
// })->unique('email'); // Assuming 'email' is unique for each user
// return $user;
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

// $products = Product::with(['ratings.productuser'])  // Load reviews and their owner info
//                     ->whereIn('user_id', [null, 3, 5]) // Select products with user_id = null (admin) or specific user_ids
//                     ->get();
// return $products;

// Looping through the products and accessing reviews with owner data


// $rev = [];  // Initialize the $rev array

// foreach ($uniqueOwners as $key => $user) {
//     // Get reviews for the user based on user_id
//     $reviews = ProductReview::where('user_id', $user['user_id'])->get();

//     // Convert the collection of reviews to an array and merge with $rev
//     $rev = array_merge($rev, $reviews->toArray());
// }
// return $uniqueOwners;
//now products.
$prod=Cart::where('user_id',Auth::user()->id)->with('product')->with('product.firstPhoto')->get();
// return $prod;
// return $country;
// $countries = json_decode($country, true);
// return $country;
// return $uniqueOwners;

// $groupedReview = collect($groupedReviews);
// return $uniqueOwners;


        return view('frontEnd.checkout',compact('uniqueOwners','prod','country','scountry', 'groupedReviews'));
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
    //  return $item;
    foreach($items as $data){
        $orderItem=new OrderItem();
        $orderItem->order_id=$order->id;
        $orderItem->qty=$data->qty;
        $orderItem->product_id=$data->product_id;
        $orderItem->product_id=$data->product_id;
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
            // Show the original quantity of the product
            // echo 'Original Product Quantity: ' . $prod->product->quantity . ' ';

            // Show the quantity of the product in the cart
            // echo 'Cart Quantity: ' . $prod->qty . ' ';

            // Calculate the remaining quantity
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

            //user ki notification
            // if (!in_array($userProd, $userProdNoti)) {
            //     $userProdNoti[] = $userProd;
            // }
            // if (!in_array($ownid, $ownersId)) {
            //     $ownersId[] = $ownid;
            // }
            // Show the remaining quantity after subtraction
            // echo 'Remaining Quantity: ' . $remainingQty . '<br>';
            //send purchase Email
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

    $notification->link='/this is link';

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
// //yahn pyyy owners ko notifications
// foreach($ownersList as $owner)
// $gotAOrder=new Notification();
// $gotAOrder->user_id=$prod->product->productusername->id;



if (!empty($userPurchaseitems)) {
    $msg = "The following item has been Order:";
    foreach ($userPurchaseitems as $item) {
        $msg .= "\n - " . $item->title; // Assuming 'name' is a property of the product
    }

    // Assuming the first product's user can be contacted
    // $owner = $userPurchaseitems[0]->productusername; // Assuming you have a relationship called 'productuser'
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



// if (!empty($outOfStockProducts)) {
//     $msg = "The following items are out of stock:";
//     foreach ($outOfStockProducts as $outOfStockProduct) {
//         $msg .= "\n - " . $outOfStockProduct->title; // Assuming 'name' is a property of the product
//     }


//       // Send the email
//       if ($outOfStockProducts[0]->is_admin == 1) {
//         Mail::to('admin@gmail.com')->send(new \App\Mail\ProductOutOfStock($msg, $outOfStockProducts));
//     } else {
//         $owner = $outOfStockProducts[0]->productusername; // Assuming you have a relationship called 'productuser'
//         if ($owner) {
//             Mail::to($owner->email)->send(new \App\Mail\ProductOutOfStock($msg, $outOfStockProducts));
//         }
//     }
// }
// $msg="Your Item is Out Of Stock";
// // Send an email to the product owner
// if($prod->product->is_admin== 1){
//     Mail::to('admin@gmail.com')->send(new \App\Mail\ProductOutOfStock($msg,$prod->product));
// }else{
// $owner = $prod->product->productusername; // Assuming you have a relationship called 'productuser'
// if ($owner) {
//     Mail::to($owner->email)->send(new \App\Mail\ProductOutOfStock($msg,$prod->product));
//     // return $prod->product;
// }
// }
    // $data=Cart::where("user_id",Auth::user()->id)->delete();
    // $items=Cart::where('user_id',Auth::user()->id)->get();

    // $data=Cart::where("user_id",Auth::user()->id)->with('product')->get()->all();
    // if($data != NULL){
    //     foreach($data as $prod){
    //         // echo $prod->product->quantity-;
    //         foreach($items as $cartItem){
    //             echo $prod->product->quantity.' ';
    //            echo  $prod->product->quantity - $cartItem->qty;
    //         }
    //     }
    // }
    // return $data;
 }
    // Authenticated user ki products lein
// $products = Product::where('user_id', auth()->id())->pluck('id');
// // return $products;
// // Orders lein jinmein ye products hain
// $orders = Order::whereHas('items', function ($query) use ($products) {
//     $query->whereIn('product_id', $products);
// })->with('items.product.firstPhoto')  // Ye line orders ke saath items aur products bhi laegi
// ->latest()->get();
// return $orders;

// $orders=Order::with('userProduct')->get()->all();
// $products = Product::where('user_id', auth()->id())->pluck('id');
// // $user = Auth()->id();
// $orders = Order::whereHas('items', function ($query) use ($products) {
//     $query->whereIn('product_id', $products);
// })->with('items.product.firstPhoto')  // Ye line orders ke saath items aur products bhi laegi
// ->latest()->get();
 public function ordersPage(){

$ownerId = Auth()->id(); // Specific owner ID ke hisaab se filter karne ke liye
$orders = Order::whereHas('items.product', function ($query) use ($ownerId) {
    $query->where('user_id', $ownerId);
})

->with('orderMaker.accountUser','items.product') // Related product and photo data include karne ke liye
->latest()->get();

// return $orders;
//  return $orders;

return view('frontEnd.orders',compact('orders'));
            // // Authenticated user ki products lein
            // $products = Product::where('user_id', auth()->id())->get();
            // $orderIds = $products->pluck('id');
    
            // // Orders lein jinme ye products hain
            // $orders = Order::whereHas('items', function ($query) use ($orderIds) {
            //     $query->whereIn('product_id', $orderIds);
            // })->get();

            // // return $orderIds;
            // return $orders;
    // $order=Order::where('user_id',Auth::user()->id)->get()->all();
    // return $order;
    // $order=Order
//  $orderItem=Order::with('userProduct')->get()->all();
    // $orderItem=$orderItem->where('products->user_id',Auth::user()->id)->get();
    // return $orderItem;

    // $orderItems = Order::with('userProduct')->get()->filter(function($order) {
    //     // Filter orders where at least one product belongs to the authenticated user
    //     return $orderItems->products->contains('user_id', Auth::user()->id);
    // });
    // return $orderItems;
 }

 public function orderinfo($id){
    
    // $order=OrderItem::where('id',$id)->with('product','product.productSize', 'product.productColors','order')->first();

    // $orderItem = OrderItem::where('order_id',$id)->get()->first();
    // return $orderItem;
    // return $orderItem;
    //  $ownerId = Auth()->id(); // Specific owner ID ke hisaab se filter karne ke liye
    // $orders = Order::whereHas('items.product', function ($query) use ($ownerId) {
    // $query->where('user_id', $ownerId);
// })

// ->with('orderMaker.accountUser','items.product') // Related product and photo data include karne ke liye
// ->latest()->get();

// $orders= Order::whereHas('items',function($query) use ($id){
//     $query->where('order_id',$id);
// })->whereHas('items.product',function($query) {
//     $query->whereNotNull('user_id');
// })->with([
//     'items.product',
//     'items.product.firstPhoto',
//     'items.product.getProductCol',
//     'items.product.getProductSiz',

//         //     'items.product' => function ($query) {
//         //     $query->with(['getProductCol']);
//         //     $query->with(['getProductSiz']);
//         // },
//         // 'items.product' => function ($query) {
//         //     $query->with(['getProductSiz']);
//         // },

//     //     'items.productSize',
//     //     'items.product' => function ($query) {
//     //     $query->with(['getProductSiz']);
//     // },
//     // 'items.product.productColors',
//     // 'items.product.productSize',
//     'items.product.subCategory',
//     'items.product.subCategory.MainCategory',
//     'orderMaker',
//     'items.order.getState',
//     'items.order.getCountry',
//     'order'
// ]

                      
    
    // )
    // ->get()->first();
// return $orders;  
    // $order = OrderItem::with(['product', 
    //                        'product.productColors' => function ($query) use ($orderItem) {
    //                            $query->where('id', $orderItem->color_id);
    //                        }, 
    //                        'product.productSize' => function ($query) use ($orderItem) {
    //                            $query->where('id', $orderItem->size_id);
    //                        },

    //                        'product.firstPhoto',
    //                        'product.brand',
    //                        'order', 
    //                        'order.diffShip' => function ($query) use ($orderItem) {
    //                         $query->where('id', $orderItem->order_id);
    //                     },
    //                     'product.subCategory',
    //                     'product.subCategory.MainCategory',

    //                     'order.getState',
    //                     'order.getCountry',

    //                        ])
    // ->where('id', $id)
    // ->first();
    // return $orders;
    $orders= Order::whereHas('items',function($query) use ($id){
        $query->where('order_id',$id);
    })->whereHas('items.product',function($query) {
        $query->whereNull('user_id');
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