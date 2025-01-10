<?php

namespace App\Providers; 

use Illuminate\Support\ServiceProvider;
use App\Models\M_Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Notification;
use Auth;

use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
   
  
   public function register()
   {
       //
   }

   /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
         View::composer('*', function ($view) {
            // $mainCategory=M_Category::with('subCategories')->get();
            //  return $mainCategory;
            //  $subCategory=Sub_Category::
            // $categories = M_category::with([
            //     'subCategories',
            //     'subCategories.products' => function ($query) {
            //         // Products ko filter karenge aur latest products ko select karenge
            //         $query->with('firstPhoto')->latest()->take(5); // Latest 5 products
            //     },
            //     'subCategories.products.brand',
            // ])->get();
            //last working
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



            // $data=[];

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
            // dd($categories);
    
           
            // return $categories;
        //     // Fetch all main categories with their subcategories
        //     // $mainCategories = M_Category::with('subCategories')->get();
    
        //     // // Fetch all brands linked to products with active subcategories
        //     // $brands = Brand::whereHas('products.subCategory', function ($query) {
        //     //     $query->whereNotNull('m_id'); // Ensures subcategories have main category
        //     // })->distinct()->get();
    
        //     // $view->with([
        //     //     'mainCategories' => $mainCategories,
        //     //     'brands' => $brands,
        //     // ]);
        //     $mainCategories = M_Category::get()->all();
        //     // dd( $mainCategories); Sub_Category.php
        //     $subCategories=Sub_
        //     $subCategories=[];
        //     // foreach($mainCategory as $cate){
        //     //     $subCategorie['name']=$cate->subCategories;
        //     // }
        //     // dd($subCategories); 
        //     $subCategories = []; // Initialize empty array

// foreach ($mainCategories as $mainCategory) {
//     foreach ($mainCategory->subCategories as $subCategory) {
//         $subCategories[] = [
//             'name' => $subCategory->name, // Add subcategory name
//             'id' => $subCategory->sub_id,     // Add subcategory ID (optional)
//         ];
//     }
// }

// Check the resulting array
// dd($subCategories);

            // dd($mainCategory);
            // $subCategoryIds = $mainCategory->subCategories->pluck('s_id')->toArray();
            // dd($subCategories);
                // dd($mainCategory);
            // Fetch Subcategories
            // $subCategories=[];
            // foreach($mainCategory as $mCat){

            // }
            // $subCategories = $mainCategory->subCategories;
            // $subCategories = $mainCategory->subCategories->toArray();
            //     return $subCategories;
            // Fetch Brands associated with these Subcategories
            // $brands = Brand::whereHas('products', function ($query) use ($subCategories) {
            //     $query->whereIn('sub_category_id', $subCategories->pluck('id'));
            // })->get();
    
            // Fetch Latest Products from these Subcategories
            // $latestProducts = Product::whereIn('sub_category_id', $subCategories->pluck('id'))
            //     ->latest()
            //     ->take(4)
            //     ->get();
            if(Auth::user()){
        $notification = Notification::where('is_read', 0)
        ->where('user_id', Auth::user()->id)
        ->count();
            }else{
                $notification=Null;
            }
            // dd($notification);
            View::share (
                // 'mainCategory'   => $mainCategory,
                // 'subCategories'  => $subCategories,
                // 'brands'         => $brands,
                // 'latestProducts' => $latestProducts,
                'categories',$categories,  
                // 'notification',$notification,

            );
            view::share('notifica',$notification,);
         });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     //
    // }
}
