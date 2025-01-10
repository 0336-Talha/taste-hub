<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use File;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $brand=Brand::get()->all();
            return response()->json($brand);
        }
         return view('admin.brands');
        
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
             $image->move(public_path('brandImages'),$fileName);
             // $filesData[]='files/'.$fileName;
 
             return "brandImages/".$fileName;
 
         // dd($image, $oldImagePath);
     }

    public function storebrand(Request $request)
    {
         
    //    return $request->all();
        $brand=[];
        $brand['name']=$request->name;

        if ($request->hasFile('photo')) {
            // $data['image1'] = $this->handleImageUpload($request->file('image1'),$request->oldimage1);
            $brand['image']= $this->handleImageUpload($request->file('photo'),$request->oldimage);
        }
       $dat=Brand::updateOrCreate(
        ['id'=>$request->id],
        $brand
       );

        return response()->json(['success']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
