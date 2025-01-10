<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sub_Category;
use App\Models\M_Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function index(Request $request){
        // $data = M_Category::with('subCategories')->get();
        // return $data;
         if($request->ajax()){
            //  $data=Sub_Category::where('id',1)->with('MainCategory')->first();
            //  return response()->json($data);
            $data = M_Category::with('subCategories')->get();
            return response()->json($data);

         }else{
         return view('admin.category');
            
         }
    }


    public function storeMainCategory(Request $request){
        //  return $request->all();
        $validated = $request->validate([
            'category_name' => 'required|string|max:130|unique:m_categories,name',
        ]);
        if(!$validated){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data=[];
        $data['name']=$request->category_name;

        $dat=M_Category::updateOrCreate(
            ['m_id' =>$request->mid],
            $data
        );

        
        return response()->json('success');
    }


    public function deleteMainCategory($id){
        $cate=M_Category::where('m_id',$id)->delete();
        return response()->json(['success'=>'success']);
    }


    public function getMainCategory(){
        $mCategory=M_Category::get()->all();
        return response()->json($mCategory);
    }

    public function getSubCategory(){
        $subCat=Sub_Category::get()->all();
        return response()->json($subCat);
    }

    public function storeSubCategory(Request $request){
        // return $request->all();
        $data=Sub_Category::where('m_id',$request->main_category_id)->where('name',$request->category_name)->get()->first();
        if($data == null){
            // return "hii"; // jb data unique ho 
        //         $subCat=new Sub_Category();
        //   $subCat['m_id']=$request->main_category_id;
        //  $subCat['name']=$request->category_name;
        //  $subCat->save(); 
  
        $data=[]; 
        $data['name']=$request->category_name;
        $data['m_id']=$request->main_category_id;
        $dat=Sub_Category::updateOrCreate(
            ['sub_id' =>$request->sub_id],
            $data
        ); 
            
          return response()->json('success');

        }else{
            // return "hello";
            return response()->json(['status'=>422, 'error'=>"This Category is Already Exsist"]);
        }
        // if($data == null ){
        //     return response()->json(['status'=>422, 'error'=>"This Category is Already Exsist"]);
        // }else{
        // $subCat=new Sub_Category();
        // $subCat['m_id']=$request->main_category_id;
        // $subCat['name']=$request->category_name;
        // $subCat->save();

        // return response()->json('success');
        // }

        // $validated = $request->validate([
        //     'category_name' => 'required|string|max:130|unique:sub__categories,name',
        // ]);
        // if(!$validated){
        //     return response()->json([
        //         'success' => false,
        //         'errors' => $validator->errors()
        //     ]);
        // }

    }


    public function deleteSubCategory($subid){
        $cate=Sub_Category::where('sub_id',$subid)->delete();
        return response()->json(['success'=>'success']);
    }


}
