<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Sub_Category;

use App\Models\ProductPhotos;
use App\Models\ProductColors;
use App\Models\ProductSize;
use App\Models\ProductOffer;  
use App\Models\Notification;  



use Auth;
use Validator;

use File;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brand=Brand::get()->all();
        $category=Sub_Category::get()->all();
        // return $category;
        return view('frontEnd.addProduct',compact('brand','category'));
    }

    private function handleImageUpload($image, $oldImagePath = null)
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


   public function storeProductImages(Request $request){
        // dd($request->all());
        $validator=$request->validate([
            'photos'=>"required",
            'photos.*'=>'mimes:jpg,png,jpeg'
        ]);

        if(!$validator){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $rec=ProductPhotos::where('product_id',null)->latest()->get();
        foreach($rec as $record){
            if (File::exists(public_path($record->photo_path))) {
                // Delete the file
                File::delete(public_path($record->photo_path));
            }
    
            // Delete the database record
            $record->delete();
        }
        $imagedata=[];
        if($files= $request->file('photos')){
            foreach($files as $key=>$file){
                // echo $file->getClientOriginalName();
                // echo "\n";
                $photo=new ProductPhotos();
                $photo['user_id']=Auth::user()->id;
                $photo['photo_path']=$this->handleImageUpload($file,null);
             
                $photo->save();
                $imagedata[] = [ // Notice the use of [] to push new entry to array
                    'id' => $photo->id,
                    'path' => $photo['photo_path']
                ];
            }
        }
        return response()->json($imagedata);
   }

  

   public function removeProductImages($id){
    
    $rec=ProductPhotos::where('id',$id)->get()->first();
   
        if (File::exists(public_path($rec->photo_path))) {
            // Delete the file
            File::delete(public_path($rec->photo_path));
        }

        $rec->delete();

        return response()->json(['success'=>'success']);

   
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     
        // $rec=ProductPhotos::where('product_id',null)->latest()->get();
        // foreach($rec as $record){
        //     if (File::exists(public_path($record->photo_path))) {
        //         // Delete the file
        //         File::delete(public_path($record->photo_path));
        //     }
    
        //     // Delete the database record
        //     $record->delete();
        // }
    public function store(Request $request)
    {
      
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

        $product['user_id']=Auth::user()->id;
    
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

        return response()->json(['success'=>'success',
    
        'redirect_url' => route('user.productPage')
    ]);
      
        }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function productsPage(Request $request){
        // return "hi";    
        $product=Product::where('user_id',Auth::user()->id)
       ->with('firstPhoto')->with('brand')->withCount(['productAllOffer'=>function($query){
        $query->where('status','0');
       }])
        ->latest()->paginate(6); 
        // return $product;
        
        // return $product;  
        // return $product;  
        //  return $product;
        // if($request->ajax()){
        //     return "helloo";
        // }else{
            // return $product;  

        return view('frontEnd.all-users-products',compact('product'));
        
    }

    // editProduct 
    public function editProduct(Request $request, $id=NULL){
        // return $id;    
        $product=Product::where('id',$id)->with('brand','subCategory','productPhotos','productColors','productSize')->get()->first();
        $producting=Product::where('id',$id)->with('productPhotos','productColors')->get()->first();

        // return $product;
        $brand=Brand::get()->all();
        $category=Sub_Category::get()->all();
        if($request->ajax()){

            return response()->json(['product'=>$producting]);
        }
        return view('frontEnd.editProduct',compact('product','brand','category'));

    //     $product=Product::where('user_id',Auth::user()->id)
    //    ->with('firstPhoto')->with('brand')
    //     ->latest()->paginate(6);
    //     //  return $product;
    //     // if($request->ajax()){
    //     //     return "helloo";
    //     // }else{
    //     return view('frontEnd.all-users-products',compact('product'));
        
    }



    public function updateProduct(Request $request, $id){
        // return $request->all();
        // return $id;
        // dd($request->all());

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
            $colorsToKeep = $request->input('color', []);
            ProductColors::where('product_id', $id)->whereNotIn('id', $colorsToKeep)->delete();
            
            if ($request->has('colors')) {
                foreach ($request->input('colors') as $color) {
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

            $prod=Product::where('id',$id)->get()->first();
            $prod['title']=$request->title;
            $prod['discription']=$request->discription;
            $prod['price']=$request->price;
            $prod['quantity']=$request->quantity;

            $prod->save();




        
        
            return response()->json(['success' => true]);

    }


    public function delete($id){
        return $id; 
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

    public function viewProductOffers($id){
        //ab ho ga new kam.
        $prod=Product::where('id',$id)->where('user_id',Auth::user()->id)
        ->with(['firstPhoto',

        'productAllOffer'=> function($query){$query->where('status','0');} 
        
        , 'productAllOffer.useraccount.accountUser'])   
        ->get()->first();
        // ->where('status','0')  
        //  return $prod; 

          return view('frontEnd.viewproductoffers',compact('prod'));


        // return $prod; 
    }   

    public function acceptorrefectoffers(Request $request){ 
        // return $request->all(); 
        $offer = ProductOffer::where('id', $request->id)->with('product','product.firstPhoto')->first(); // Use first() instead of get() + first()
        // return $offer; 
        $i=0;
        $a;
        if ($offer) {
            // Check if the action is "accept"
            if ($request->check == "acc") {
                $offer->status = 1; // Set status to 1 (accepted)
                $i=1; 

                $noti = new Notification();
                $noti['user_id'] = $offer->user_id;
                $noti['type'] = 'Your Offer Status Accept';
                $noti['message'] = 'Your Offer of the product ' . $offer->product->title . ' Has Been Accepted';  // Corrected concatenation
                $noti['photo'] = $offer->product->firstPhoto->photo_path;
                $noti['link'] = '/productDetail/' . $offer->product_id;  // Corrected concatenation
                $noti->save();
                $offer->save(); 
                // $a="successfully Added"
                return response()->json(['message' => 'offer Accepetd!']);
            } elseif ($request->check == "dec") {
                $offer->status = 2; // You can set status to 2 for declined or any other logic
                $i=0;
                $noti = new Notification();
                $noti['user_id'] = $offer->user_id;
                $noti['type'] = 'Your Offer Status Reject';
                $noti['message'] = 'Your Offer of the product ' . $offer->product->title . ' Has Been Rejected';  // Corrected concatenation
                $noti['photo'] = $offer->product->firstPhoto->photo_path;
                $noti['link'] = '/productDetail/' . $offer->product_id;  // Corrected concatenation
                $noti->save();
                $offer->save(); 
                return response()->json(['message' => 'offer Rejected!']);
 
            }
        
            // Save the changes
            // $offer->save(); // Save using save method
        //     if()
        //     return response()->json(['message' => 'Offer status updated successfully!']);
        // } else {
        //     return response()->json(['message' => 'Offer not found!'], 404);
        // }
    }
}

}
