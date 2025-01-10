<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


use App\Models\Brand;
use App\Models\Sub_Category;

use App\Models\ProductPhotos;
use App\Models\ProductColors;
use App\Models\ProductSize;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTracking;
use App\Models\User;

use Carbon\Carbon;
use Mail;




use Auth;
use Validator;

use File;
use Session;
class AdminProductController extends Controller
{
    //
    public function handleImageUpload($image, $oldImagePath = null)
    {
        //  dd($image, $oldImagePath);
       
        if($oldImagePath){
            $image_path = $oldImagePath;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $fileName=time().'.'.$image->getClientOriginalName();
            $image->move(public_path('productImages'),$fileName);
            // $filesData[]='files/'.$fileName;

            return "productImages/".$fileName;

        // dd($image, $oldImagePath);
    }
    
    public function index(Request $request, $filter=null){
      
        if($request->ajax()){
            // return $filter;
            // $prod=Product::with('firstPhoto')->get()->all();
            // return response()->json($prod);
            $query = Product::with('firstPhoto');


            if ($filter) {
                switch ($filter) {
                    case 'admin':
                        // Example: Filter by category, you can customize based on your schema
                        $query->where('is_admin', '1');
                        break;
                    case 'user':
                        // Example: Filter by price range
                        $query->where('is_admin', NULL);
                        break;
                    // Add more cases for other filter types
                    default:
                        $query->get()->all();
                        // You can add default behavior here if needed
                        break;
                }
            }

            $prod = $query->latest()->get();

            // Return the result as JSON for the AJAX request
            return response()->json($prod);
        }

    

 
        return view('admin.adminproduct');
    }

    
    
    public function storeProduct(Request $request){
        // dd($request->all());
              
        $validator=$request->validate([
            'photos'=>"required",
            'photos.*'=>'mimes:jpg,png,jpeg',
            'title'=>'required',
            'brand'=>'required',
            'category'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'colors'=>'required',
            'size'=>'required',
            'discription'=>'required',
        ]);

        if(!$validator){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        //  dd($request->all());
        $product=new Product();
        
        $product['title']=$request->title;
        $product['brand_id']=$request->brand;
        $product['sub_id']=$request->category;
        $product['discription']=$request->discription;
        $product['price']=$request->price;
        $product['quantity']=$request->quantity;

        $product['is_admin']='1';
        $product['is_feature']='1';

        $product->save();

        // $imagedata=[];
        if($files= $request->file('photos')){
            foreach($files as $key=>$file){
                // echo $file->getClientOriginalName();
                // echo "\n";
                $photo=new ProductPhotos();
                // $photo['user_id']=Auth::user()->id;
                $photo['photo_path']=$this->handleImageUpload($file,null);
                $photo ['product_id'] =$product->id;

                $photo->save();
            
            }
        }
        if($colors=$request->colors){
            foreach($colors as $key=>$color){
                $col=new ProductColors;
                $col['color']=$color;
                $col['product_id'] =$product->id;
                $col->save();
            }

        }

        if($size=$request->size){
            foreach($size as $key=>$size){
                $siz=new ProductSize;
                $siz['size']=$size;
                $siz['product_id'] =$product->id;
                $siz->save();
            }

        }
        session()->flash('success', 'Product has been added successfully!');

        return response()->json(['success'=>'success']);
    }

    public function editor($id){
        $prod=Product::where('id',$id)->with('productPhotos')->with('productColors')->with('productSize')->with('brand')->with('subCategory')->get()->first();
        // foreach($prod['product_photos'] as $item){
        //     return $item->photo_path;
        // }
//         $photoPaths = [];
//     if ($prod) {
//     foreach ($prod->productPhotos as $item) {
//         $photoPaths[] = $item->photo_path; // Collecting photo paths
//     }
//     return $photoPaths; // Return all photo paths after the loop
// }
     
        return response()->json(['product'=>$prod]);
        }




        public function update(Request $request, $id){
        
            //  dd($request->all());
            $imagesToKeep = $imagesToKeep = $request->input('existing_photos', []);
            // return $imagesToKeep;
                // Find images that are not in imagesToKeep and delete them from storage
            $imagesToDelete = ProductPhotos::where('product_id', $id)
            ->whereNotIn('id', $imagesToKeep)->get();
            // return $imagesToDelete;
            if($imagesToDelete !== Null){
                    // Loop through and delete the physical files
             foreach ($imagesToDelete as $image) {
            // Check if the file exists before attempting to delete
            if(File::exists($image->image_path)) {
            File::delete($image->image_path);
            }
        // Then delete the record from the database
             $image->delete();
        }

            }

            //deletion complete now storing new images.
                // Store new images
      if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $file) {
            // $path = $file->store('productImages'); handleImageUpload
            $path=$this->handleImageUpload($file,null);
            ProductPhotos::create([
                'product_id' => $id,
                'photo_path' => $path,
            ]);
        }
    }

    //same cheez ab Color Edit krny main use kron ga.
    $colorsToKeep = $request->input('existing_colors', []);
    ProductColors::where('product_id', $id)->whereNotIn('id', $colorsToKeep)->delete();
    
    if ($request->has('new_colors')) {
        foreach ($request->input('new_colors') as $color) {
            ProductColors::create([
                'product_id' => $id,
                'color' => $color,
            ]);
        }
    }

    $newSizes = $request->input('size', []);
    // Remove old sizes related to the product
    ProductSize::where('product_id', $id)->delete();

    // Store new sizes
    foreach ($newSizes as $size) {
        ProductSize::create([
            'product_id' => $id,
            'size' => $size,
        ]);
    }


    return response()->json(['success' => true]);

        }

        public function delete($id){
            // return $id;
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }
            ProductSize::where('product_id', $id)->delete();

            $imagesToDelete = ProductPhotos::where('product_id', $id)->get();
            return $imagesToDelete;
            if($imagesToDelete !== Null){
                // Loop through and delete the physical files
         foreach ($imagesToDelete as $image) {
            // $imagePath = public_path($image->photo_path);
            $imagePath =public_path().'/'.$image->photo_path;
            return $image;

        // Check if the file exists before attempting to delete
        if(File::exists($imagePath)) {
        File::delete($imagePath);
        }
        // Then delete the record from the database
        //  $image->delete();
        }
         }

         ProductPhotos::where('product_id', $id)->delete();

         // Optionally: Delete colors, if applicable
         ProductColors::where('product_id', $id)->delete();
     
         // Finally, delete the product itself
         ProductSize::where('product_id', $id)->delete();
         
         $product->delete();


         return response()->json(['success' => 'Product and associated data deleted successfully']);
        }


public function adminNotification(){
    // return "hi";
    $noti=Notification::where('user_id',Null)->latest()->get();
    // return $noti;
    return view('admin.adminNotification',compact('noti'));
}

public function adminOrders(){
//     $products = Product::where('user_id', NULL)->pluck('id');


// $order=OrderItem::whereIn('product_id',$products)->with(
//     'product.firstPhoto',
//     'order'
// )->latest()->get();
$order = Order::whereHas('items.product', function ($query)  {
    $query->where('user_id', Null);
})

->with(['orderMaker.accountUser',

// 'items.product' => function ($query) {
//     $query->where('user_id', Null);
// },
'items' => function ($query) {
    $query->whereHas('product', function ($query) {
        $query->whereNull('user_id');
    });
},
'items.product' => function ($query) {
    $query->whereNull('user_id');  // Ensure product's user_id is null
}
])
// Related product and photo data include karne ke liye
->latest()->get();

// return $order;
return view('admin.orders',compact('order'));
    // return 'hi from Admin Orders';
    // return "hi";
    // $noti=Notification::where('user_id',Null)->get()->all();
    // // return $noti;
    // return view('admin.adminNotification',compact('noti'));
}

public function adminOrderInfo($id){
    // $orderItem = OrderItem::find($id);
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

    //                 ])
    // ->where('id', $id)
    // ->first();
    
    // return $order;
    $orders= Order::whereHas('items',function($query) use ($id){
        $query->where('order_id',$id);
    // })->whereHas('items.product',function($query) {
    //     $query->whereNull('user_id');
    })->with([
        // 'items.product',
        'items.product.firstPhoto',
        // 'items.product.getProductCol',
        'items.product.getProductSiz',
        'items.trackingNumber',
        'items.orderColor',


    
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
    return view('admin/orderInfo',compact('orders'));
}

public function userOrdersManager(Request $request, $filter=null){
    // return $filter;
//     $orderon = Order::with([
//         'orderMaker.accountUser',
//         'items' => function ($query) {
//             $query->whereNull('order_trackings_id'); // Null tracking ke liye filter
//         },
//     ])
//     ->whereHas('items', function ($query) {
//         $query->whereNull('order_trackings_id'); // Sirf un orders ko laane ke liye jinke items ka tracking ID NULL ho
//     })
//     ->where('created_at', '<', Carbon::now()->subDays(2)) // Sirf 2 din se purane orders
//     ->latest()
//     ->get();

// return $orderon;

    // $orderon = Order::with(['orderMaker.accountUser',
    // 'items'=> function ($query) {
    //     $query->whereNull('order_trackings_id');
    // },
    // 'items.product'
    // ])
    // ->whereHas('items', function ($query) {
    //     $query->whereNull('order_trackings_id'); // Sirf un orders ko laane ke liye jinke items ka tracking ID NULL ho
    // }) // Related product and photo data include karne ke liye
    // ->latest()->get();
    // return $orderon;
    // $order=OrderItem::with('product','product.productuser','product.firstPhoto','order',
     
    // )->latest()->get();
    // $order = OrderItem::whereHas('product', function ($query) {
    //     $query->whereNotNull('user_id');
    // })
    // ->with('product', 'product.productusername', 'product.firstPhoto', 'order')
    // ->latest()
    // ->get();

    $orders = Order::with('orderMaker.accountUser','items.product') // Related product and photo data include karne ke liye
    ->latest()->get();
    
    
    // return $orders;
    //  return $orders;
    
    // return view('frontEnd.orders',compact('orders'));
    if($request->ajax()){
        // return $filter;
        if ($filter=="moreTime") {
        $orders = Order::with([
        'orderMaker.accountUser',
        'items' => function ($query) {
            $query->whereNull('order_trackings_id'); // Null tracking ke liye filter
        },
        'items.product'
    ])
    ->whereHas('items', function ($query) {
        $query->whereNull('order_trackings_id'); // Sirf un orders ko laane ke liye jinke items ka tracking ID NULL ho
    })
    ->where('created_at', '<', Carbon::now()->subDays(2)) // Sirf 2 din se purane orders
    ->latest()
    ->get();
    return response()->json($orders);
            }

            
        return response()->json($orders);
        }

      


    
    // return $orders;
    // return $orders;

    return view('admin.userOrders',compact('orders'));


}

public function updateAdminTracking(Request $request){
    // return $request->all();
    $orderItems = OrderItem::where('order_id', $request->itemid)
    ->whereHas('product', function($query) {
        $query->whereNull('user_id'); // Sirf woh products jinke user_id non-null hain
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
                'owner_id' => Null,
            ],
            [
                'tracking_number' => $request->trackNo,
            ]
        );

        foreach ($items as $item) {
            $item->order_trackings_id = $tracking->id;
            $item->save();
        }
 

    }
    return response()->json(['success']);

}

public function sendEmailToUser(Request $request){
    // return $request->id;
        // Order id ko request se receive karna
        $orderId = $request->id;

        // Order items ko filter karna jo 2 din se zyada time se track number nahi hain
        $orderItems = OrderItem::where('order_id', $orderId)
            ->whereNull('order_trackings_id') // Filtering for missing tracking numbers
            ->where('created_at', '<', now()->subDays(2)) // 2 din se zyada purana
            ->with('product',
            'product.productusername'
            ) // Product details ko load karna
            ->get();
            $owners = $orderItems->groupBy('product.user_id');

            foreach ($owners as $ownerId => $items) {
                // Email bhejna owner ko
                $owner = User::find($ownerId);
                // echo $items;
                if ($owner) {
                    // Mail::to($owner->email)->send(new TrackingNumberReminder($owner, $items));
                    Mail::to($owner->email)->send(new \App\Mail\TrackingNumberReminder($owner, $items));
                }
            }

            return response()->json(['message' => 'Reminder emails sent successfully']);
        // return $owners;
}
}
