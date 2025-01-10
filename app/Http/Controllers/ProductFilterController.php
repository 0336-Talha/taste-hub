<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Category;
use App\Models\ProductColors;
use App\Models\ProductSize;
use App\Models\Product;
use App\Models\Brand;
use Auth;


// use App\Models\M_Category;
// use App\Models\Brand;
// use App\Models\Product;
// use Illuminate\Support\Facades\View;
class ProductFilterController extends Controller
{
    //

    public function index(Request $request, $search=Null){
        // $search = $request->query('search');  /// yahn dekhon ga agy
    //    return $search;



        $category = M_Category::with('subCategories')->get();
        $brand=Brand::select('*')->distinct()->get();

        $color=ProductColors::select('*')->distinct()->get();

        $size=ProductSize::select('*')->distinct()->get(); 

        $query=Product::query();

        if($request->ajax()){
            $query=Product::query();

            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%');  
                    //   ->orWhere('description', 'LIKE', '%' . $search . '%');
                });
            }

         if ($request->has('subCategory') && $request->subCategory) {
            $query->where('sub_id', $request->subCategory);
        }

        
        if ($request->has('brandid') && $request->brandid) {
            $query->where('brand_id', $request->brandid);
        }

            // Filter by Size
            if ($request->has('size') && $request->size) {
                $query->whereHas('productSize', function ($q) use ($request) {
                    $q->where('size', $request->size);
                });
            }

                        // Filter by Color
                        if ($request->has('color') && $request->color) {
                            $query->whereHas('productColors', function ($q) use ($request) {
                                $q->where('color', $request->color);
                            });
                        }

                                // Price filter (High to Low or Low to High)
        if ($request->has('price') && $request->price) {
            $priceOrder = $request->price == 'lowhigh' ? 'asc' : 'desc';
            $query->orderBy('price', $priceOrder);
        }



        $wishlistProductIds=['0'];
        if(Auth::user() != Null){
        $user = Auth::user();

        // Fetch products in the user's wishlist
        $wishlistProductIds = $user->wishlists->pluck('product_id')->toArray();
        // return $wishlistProductIds;
        }

        // return $wishlistProductIds;

        // return $request->all();
        $product=$query->with('firstPhoto','productusername','productUser')->get();

        $html = '';
        if($product != Null){
        foreach($product as $item){
           $html .= '
           <div class="col">
           <div class="product_item mini">
               <button type="button" id="whishlist"
                   style="' . (in_array($item->id, $wishlistProductIds) ? 'background-color: orange;' : '') . '"
                   data-id="' . $item->id . '" active="true" class="like_btn active">
                   <img src="' . asset('/front/assets/images/icon-heart.svg') . '" alt="Like Button">
               </button>
               <div class="image">
                   <a href="' . route('user.productDetail', $item->id) . '">
                       <img src="' . asset($item->firstPhoto->photo_path) . '" alt="Product Photo">
                   </a>
               </div>
               <div class="text">
                   <div class="title"><a href="' . route('user.productDetail', $item->id) . '">' . $item->title . '</a></div>
                   <div class="start_price"><small>Starting</small> ' . $item->price . '</div>
               </div>
           </div>
       </div>';
        }

        
        }

        
    return response()->json(['html' => $html]);

    }


        

        // return $size;
        $product=$query->with('firstPhoto','productusername','productUser')->get();

        // return $product;
    

        return view('frontEnd.filter',compact('color','category','brand','product'));
    }

    public function search(){
        $product=Product::select('title')->get();
        $data=[];
        foreach($product as $prod){
            $data[]=$prod['title'];
        }
        return $data;
        // return "hi";
    }

    public function make(){
        // return "hi";
         $mainCategory=M_Category::with('subCategories')->get();
        //  return $mainCategory;
        //  $subCategory=Sub_Category::
        $categories = M_category::with([
            'subCategories',
            'subCategories.products' => function ($query) {
                // Products ko filter karenge aur latest products ko select karenge
                $query->with('firstPhoto','brand')->latest()->take(5); // Latest 5 products
            },
            'subCategories.products.firstPhoto',
            'subCategories.products'=>function($query){
                $query->with('brand')->distinct('id')->get();
            },
        ])->get();

        // $brand = M_category::with([
        //     'subCategories.products.brand',
        // ])->get();
        

        // $br=[];
        // foreach($brand as $bran){
        //     foreach($bran->subCategory as $subCategory){
        //         foreach($subCategory->product as $prod){
        //             $br['name']=$prod->brand->name;
        //         }
        //     }
        // }
        $data=[];

        foreach ($categories as $category) {
            foreach ($category->subCategories as $subCategory) {
                // Filter unique brands
                // $subCategory->unique_brands 
                $category->branding = $subCategory->products
                    ->pluck('brand') // Extract brands
                    ->unique('id')   // Ensure uniqueness
                    ->values();      // Reindex the collection
                    // $data['sub']=$subCategory->unique_brands;
            }
        //    $category->subData=$data;
        }

        // return $br=[];
        // return $data;
       
        return $categories;

           
    }
}
