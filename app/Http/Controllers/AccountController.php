<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Tbl_Country;
use App\Models\Tbl_State;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Account;
use File;
use App\Repositories\UserRepository;
use Hash;



class AccountController extends Controller
{
    //
    public function index(){
        $country=Tbl_country::get()->all();
        // $b=Tbl_State::get()->all();
        // return $b;
        // return $country;
        $string=Auth::user()->name;
        $arrayString=  explode(" ", $string );
        $firstName=$arrayString[0];
        $lastName=$arrayString[1];
        $account=Account::where('user_id',Auth::user()->id)->get()->first();
        if (is_null($account)) {
            $account = new Account(); // Create an empty instance instead of an array
        }
        
        // return $account;
        return view('frontEnd.account',compact('firstName','lastName','country','account'));
    }

    public function getState($id){
        $state=Tbl_State::where('country_id',$id)->get()->all();
        return response()->json(['state'=>$state]);
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
            $image->move(public_path('profileImages'),$fileName);
            // $filesData[]='files/'.$fileName;

            return "profileImages/".$fileName;

        // dd($image, $oldImagePath);
    }

    public function accountStore(Request $request){

        // return $request->all();
        $account=[];
        if($request->photo != null){
        $validated = $request->validate([
            'photo' => 'image|mimes:jpeg,jpg,png|max:500|min:80'
        ]);
       
        if(!$validated){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        } else{

            $account['photo']=$this->handleImageUpload($request->file('photo'),$request->oldimage);
        
        }
    }

        $validated=$request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'number'=>'required',
            'email'=>'required',
        ]);
        if($validated){
    
            $f=$request->fname;
            $l=$request->lname;
       
            $user=User::where('id',Auth::user()->id)->get()->first();
            $user->name=$f.' '.$l;
            $user->email=$request->email;
            $user->number=$request->number;

            $user->save();

            $account['address']=$request->address;
            $account['city']=$request->city;
            $account['country_id']=$request->country;
            $account['state_id']=$request->state;
            $account['birthdate']=$request->date;
            $account['gender']=$request->gender;
            $account['zip']=$request->zip;
            $account['user_id']=Auth::user()->id;

            $acc=Account::updateOrCreate(
                [ 'user_id'=>Auth::user()->id   ],
                $account
            );



        return response()->json([$account]);

        }


        return $request->all();


        
    }

       
        
    public function accountPassword(Request $request){
        // return $request->all();
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:5|string'
        ]);
        $auth = Auth::user();
 
 // The passwords matches
        if (!Hash::check($request->get('current_password'), $auth->password)) 
        {
            return response()->json(["error"=>"Current Password is Invalid"]);

        }
 
// Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) 
        {
            
            return response()->json(["error"=>"New Password cannot be same as your current password."]);
        }
 
        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    
    }

    
}
