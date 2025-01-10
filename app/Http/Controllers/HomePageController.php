<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site_Page;

use Illuminate\Support\Facades\File;
class HomePageController extends Controller
{
    //
    public function indexHome(Request $request){
        $p_name= request()->segment(count(request()->segments()));

        if($request->ajax()){
            $data=Site_Page::where('p_name',$p_name)->first();
            return response()->json($data);
        }else{
        return view('admin.homepage');
        }
        // $data=Site_Page::where('p_name',$p_name)->first()->get();
        // return response()->json(['data'=>$data]);
    }


    private function handleImageUpload($image, $oldImagePath = null)
    {
    //    dd($image, $oldImagePath);
        if($oldImagePath){
            $image_path = $oldImagePath;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $fileName=time().'.'.$image->getClientOriginalName();
            $image->move(public_path('site_images'),$fileName);
            // $filesData[]='files/'.$fileName;
            return "site_images/".$fileName;
    }

    public function storePage(Request $request){
        //  return $request->all();
        $p_name= request()->segment(count(request()->segments()));
        // return $p_name; http://127.0.0.1:8000/admin/homePage eska "homePage"


        $data=[];
        $data['meta_data']['editor1']=$request->editor1;
        $data['meta_data']['editor2']=$request->editor2;
        $data['meta_data']['btn1txt']=$request->btn1txt;
        $data['meta_data']['btn2txt']=$request->btn2txt;

        // Handle image1 if present
        if ($request->hasFile('image1')) {
            // $data['image1'] = $this->handleImageUpload($request->file('image1'),$request->oldimage1);
            $data['meta_data']['image1']= $this->handleImageUpload($request->file('image1'),$request->oldimage1);
        }else{
            $data['meta_data']['image1']=$request->oldimage1;
        }

        $data['meta_data']['heading1']=$request->heading1;
        $data['meta_data']['editor3']=$request->editor3;

        $data['meta_data']['heading2']=$request->heading2;
        $data['meta_data']['editor4']=$request->editor4;

        $data['meta_data']['heading3']=$request->heading3;
        $data['meta_data']['editor5']=$request->editor5;

        $data['meta_data']['heading4']=$request->heading4;
        $data['meta_data']['editor6']=$request->editor6;


                // Handle image1 if present
                if ($request->hasFile('image2')) {
                    // $data['image1'] = $this->handleImageUpload($request->file('image1'),$request->oldimage1);
                    $data['meta_data']['image2']= $this->handleImageUpload($request->file('image2'),$request->oldimage2);
                }else{
                    $data['meta_data']['image2']=$request->oldimage2;
                }


                $data['meta_data']['heading5']=$request->heading5;
                $data['meta_data']["editor7"]=$request->editor7;

                if ($request->hasFile('image3')) {
                    // $data['image1'] = $this->handleImageUpload($request->file('image1'),$request->oldimage1);
                    $data['meta_data']['image3']= $this->handleImageUpload($request->file('image3'),$request->oldimage3);
                }else{
                    $data['meta_data']['image3']=$request->oldimage3;
                }

                $data['meta_data']['heading6']=$request->heading6;
                $data['meta_data']['editor8']=$request->editor8;

                if ($request->hasFile('image4')) {
                    // $data['image1'] = $this->handleImageUpload($request->file('image1'),$request->oldimage1);
                    $data['meta_data']['image4']= $this->handleImageUpload($request->file('image4'),$request->oldimage3);
                }else{
                    $data['meta_data']['image4']=$request->oldimage3;
                }

                
                $data['meta_data']['heading7']=$request->heading7;
                $data['meta_data']['editor9']=$request->editor9;

                $data['meta_data']['heading8']=$request->heading8;
                $data['meta_data']['heading9']=$request->heading9;

                $data['meta_data']['editor10']=$request->editor10;


                // print_r($data);
                //  return $request->all();

                $SitePage=Site_Page::updateOrCreate(
                    ['p_name' => 'homePage'],
                    $data
                );
        
                return view('admin.homePage');
                //  print_r($data);
                
    }
}
