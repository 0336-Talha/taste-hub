<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site_Page;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductOffer;
use App\Models\User;
use App\Models\Account; 
use App\Models\Notification; 
use App\Models\ProductReview; 






use Auth;
use App\Models\Wishlist;
class FrontPageController extends Controller
{
    //
    public function index(){
        $data=Site_Page::where('p_name','homePage')->get()->first();
        // $userProducts=Product::get()->with('firstPhoto')->with('productUser');
        $userProducts=Product::where('is_feature',NULL)->
        with('firstPhoto')->with('productUser')->with('productUserName')
         ->latest()->take(25)->get();

         $feature=Product::whereNotNull('is_feature')->
         with('firstPhoto')->with('productUser')->with('productUserName')
          ->latest()->take(25)->get();
        //   return $feature;
        //  return $userProducts;
        $wishlistProductIds=['0'];
        if(Auth::user() != Null){
        $user = Auth::user();

        // Fetch products in the user's wishlist
        $wishlistProductIds = $user->wishlists->pluck('product_id')->toArray();
     

        // return $wishlistProductIds;
        }
        $brand=Brand::get()->all();
        // return $brand;
        return view('frontEnd.index',compact('data','userProducts','feature','wishlistProductIds','brand'));
    }



    public function productDetail($id){
        $prod=Product::where('id',$id)->with('productPhotos')->with('productColors')->with('productSize')->get()->first();
        //  return $prod;
        if(Auth::user()){
        $wish=wishlist::where('product_id',$id)->where('user_id',Auth::user()->id)->get()->first();
        $offer=ProductOffer::where('product_id',$id)->where('user_id',Auth::user()->id)->where('status','1')->get()->first();
        if($wish == Null){
            $wishing="false";
        }else{
        $wishing="true";
        }
        }else{
            $wishing="false";
            $offer="";  
        }

            // Step 1: Try to fetch products with the same brand
    $similarProducts = Product::where('brand_id', $prod->brand_id)
    ->where('id', '!=', $prod->id) // Exclude the current product
    ->with('firstPhoto')->with('productUser')->with('productUserName')
    ->take(5) // Limit to 7 products
    ->get();
    // return $similarProducts;

// Step 2: If the number of products is less than 6, fetch based on the same subcategory
if ($similarProducts->count() < 5) {
    $needed = 5 - $similarProducts->count(); // Calculate how many more products we need

    // Fetch more products from the same subcategory
    $additionalProducts = Product::where('sub_id', $prod->sub_id)
        ->where('id', '!=', $prod->id) // Exclude the current product
        ->with('firstPhoto')->with('productUser')->with('productUserName')
        ->take($needed) // Limit to the remaining products
        ->get();

    // Merge the two collections (brand products and subcategory products)
    $similarProducts = $similarProducts->merge($additionalProducts);
}  

$wishlistProductIds=['0'];
if(Auth::user() != Null){
$user = Auth::user();

// Fetch products in the user's wishlist
$wishlistProductIds = $user->wishlists->pluck('product_id')->toArray();


// return $wishlistProductIds;
}

$rev = ProductReview::where('product_id', $id)
    ->with([
        'user' => function ($query) {
            $query->select('id', 'name'); // Selecting only 'id' and 'name' from the user table
        },
        'userAccount' => function ($query) {
            $query->select('user_id', 'photo'); // Selecting only 'id' and 'name' from the user table
        },
    ])
    ->get();
// return $rev;
    // return $additionalProducts;
 
        // $wishing="true";  
        // return $wishing;
        // return $offer; 
       
        return view('frontEnd.productDetail',compact('prod','wishing','offer','wishlistProductIds','similarProducts','rev'));
    }

    
    // public function productData(Request $request){
    //    return $request->all();
    // }

    public function wishlist($id){
     
        if(Auth::user() == Null){
            return response()->json(['siginIn' => 'You Are not signed in']);

        }else{
            // Check if the product is already in the user's wishlist
            $wishing = Wishlist::where('product_id', $id)
                               ->where('user_id', Auth::user()->id)
                               ->first();
        
            if ($wishing == null) {
                // If the product is not in wishlist, add it
                $wish = new Wishlist();
                $wish->product_id = $id;
                $wish->user_id = Auth::user()->id;
                $wish->save();
        
                return response()->json(['status' => 'added']);
            } else {
                // If the product is already in wishlist, remove it
                $wishing->delete();
        
                return response()->json(['status' => 'removed']);
            }
        }
        
        
     }

     public function wishlistIndex(){
        $wish=Wishlist::where('user_id',Auth::user()->id)->with('product.firstPhoto')->get();
        return view('frontEnd.wishlist',compact('wish'));
        // return $wish;
     }

     public function makeOffer(Request $request){
        // return $request->all(); 
        // $data=[];
        // $data['name']=$request->category_name;
        // $data['m_id']=$request->main_category_id;
        // $dat=Sub_Category::updateOrCreate(
        //     ['sub_id' =>$request->sub_id],
        //     $data
        // );
        $prod=Product::where('id',$request->product_id)->get()->first();

            // Validate the request
    $validated= $request->validate([
        'price' => [
            'required',
            'integer',
            function ($attribute, $value, $fail) use ($prod) {
                if ($value <= 0 || $value >= $prod->price) {
                    $fail("The $attribute must be greater than 0 and less than the product price of {$prod->price}.");
                }
            },
        ],
        'product_id' => 'required|exists:products,id',
    ]);

    // If validation passes, process the offer
    // Example: Save the offer to the database
    // Offer::create([...]);
    if(!$validated){
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ]);
    }else{
        if(Auth::user() == Null){
            return response()->json(['siginIn' => 'You Are not signed in']);

        }else{
                $offer=[];
                // $offer = new ProductOffer();
                $offer['product_id'] = $request->product_id;
                $offer['offerPrice'] = $request->price;

                $offer['user_id'] = Auth::user()->id;
                $offer['status']='0';
                // $offer->save();

             $off=ProductOffer::updateOrCreate(['product_id'=> $request->product_id, 'user_id'=> Auth::user()->id],$offer);

                $product=Product::where('id',$request->product_id)->with('productuser','firstPhoto')->get()->first();
                // return $product; 
                //get user;
                // $user=User::where('id',Auth::user()->id)->select('name')->get()->first();
                $account=Account::where('user_id',Auth::user()->id)->select('photo')->get()->first();
                // return $account;  
 

                $noti=new Notification();
                $noti->type='Created An offer Successfully';
                $noti->message="You have made the Offer for product".$product->title;
                $noti->link='/viewCreatedOffers';
                $noti->photo=$product->firstPhoto->photo_path;
                $noti->user_id=Auth::user()->id;
                $noti->save();


                $notif=new Notification();
                $notif->type='You Got New Offer';
                $notif->message=Auth::user()->name." has Create the offer for ".$product->title;
                $notif->link='/viewProductOffers/'.$product->id;
                $notif->photo=$account->photo;
                $notif->user_id=$product->user_id;
                $notif->save();




        
                return response()->json(['status' => 'added']);
            // return $off->product_id;


  
            }

        

    }


    // return response()->json([
    //     'status' => 'success',
    //     'message' => 'Offer submitted successfully!',
    // ]);
        




  
        }

    }



     


